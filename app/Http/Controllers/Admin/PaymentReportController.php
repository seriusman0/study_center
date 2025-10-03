<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\AttendancePaymentExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class PaymentReportController extends Controller
{
    /**
     * Show the payment report page with student selection
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get all active students
        $students = User::with('studentDetail')
            ->whereHas('studentDetail', function($query) {
                $query->where('is_active', true);
            })
            ->orderBy('nama')
            ->get();
        
        // Get all available periods (months for the current year)
        $periods = [];
        $currentYear = now()->year;
        
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($currentYear, $month, 1);
            $periods[$date->format('Y-m')] = $date->format('F Y');
        }
        
        // Default to current period if none selected
        $selectedPeriod = $request->period ?? now()->format('Y-m');
        $selectedStudentId = $request->student_id;
        
        // If a student is selected, gather their report data
        $reportData = null;
        
        if ($selectedStudentId) {
            $student = User::with(['studentDetail', 'journals', 'attendanceRecords', 'permissionRequests'])
                ->find($selectedStudentId);
                
            if ($student) {
                // Parse selected period
                $periodStart = Carbon::createFromFormat('Y-m', $selectedPeriod)->startOfMonth();
                $periodEnd = $periodStart->copy()->endOfMonth();
                $periodName = $periodStart->format('F Y');
                
                // Journal statistics
                $submittedJournals = $student->journals()
                    ->whereBetween('entry_date', [$periodStart, $periodEnd])
                    ->where('is_submitted', true)
                    ->count();
                
                // Attendance statistics
                $attendance = $student->attendanceRecords()
                    ->whereBetween('record_date', [$periodStart, $periodEnd])
                    ->selectRaw('SUM(regular_attendance) as regular, SUM(css_attendance) as css, SUM(cgg_attendance) as cgg')
                    ->first();
                
                $totalAttendance = ($attendance->regular ?? 0) + ($attendance->css ?? 0) + ($attendance->cgg ?? 0);
                
                // SPR Attendance statistics
                $sprAttendance = $student->attendanceRecords()
                    ->whereBetween('record_date', [$periodStart, $periodEnd])
                    ->selectRaw('SUM(spr_father) + SUM(spr_mother) + SUM(spr_sibling) as total')
                    ->first();
                
                // Permission statistics
                $permissionCount = $student->permissionRequests()
                    ->whereBetween('created_at', [$periodStart, $periodEnd])
                    ->count();
                
                // Calculate attendance percentage (assuming 3 total classes per month)
                $totalClasses = 3;
                $attendancePercentage = $totalClasses > 0 
                    ? ($totalAttendance / $totalClasses) * 100 
                    : 0;
                
                // Calculate payment based on attendance
                $spp = 0;
                if ($attendancePercentage >= 75) {
                    $spp = (int) $student->studentDetail->spp;
                    
                    // Apply appreciation if applicable (100% attendance, journals, and SPR)
                    $hasAppreciation = $attendancePercentage >= 100 && 
                                      $submittedJournals >= 25 && 
                                      ($sprAttendance->total ?? 0) >= 4;
                    
                    if ($hasAppreciation) {
                        $nominalSppDefault = (int) $student->studentDetail->nominal_spp_default;
                        $spp = min($nominalSppDefault, 700000); // Max SPP default value
                    }
                }
                
                // Standard "tagihan" value from school
                $tagihan = 700000;
                
                // Calculate remaining balance
                $sisa = $tagihan - $spp;
                
                $reportData = [
                    'student' => $student,
                    'month' => $periodStart->format('m'),
                    'period' => $periodName,
                    'spp' => $spp,
                    'tagihan' => $tagihan,
                    'sisa' => $sisa,
                    'attendance' => [
                        'regular' => $attendance->regular ?? 0,
                        'css' => $attendance->css ?? 0,
                        'cgg' => $attendance->cgg ?? 0,
                        'total' => $totalAttendance,
                    ],
                    'attendance_percentage' => $attendancePercentage,
                    'spr_attendance' => $sprAttendance->total ?? 0,
                    'journal_count' => $submittedJournals,
                    'permission_count' => $permissionCount,
                    'notes' => '',
                    'payment_note' => 'Pembayaran SPP SCGS ' . $periodName
                ];
            }
        }
        
        return view('admin.reports.payment-report', compact(
            'students',
            'periods',
            'selectedPeriod',
            'selectedStudentId',
            'reportData'
        ));
    }
    
    /**
     * Export the payment report as Excel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        try {
            $studentId = $request->student_id;
            $period = $request->period ?? now()->format('Y-m');
            
            if ($studentId) {
                // Export for specific student
                $student = User::find($studentId);
                $studentName = $student ? Str::slug($student->nama) : 'student';
                $filename = "rekap_pembayaran_{$studentName}_{$period}.xlsx";
                
                return Excel::download(
                    new AttendancePaymentExport(
                        '7-9',
                        $period,
                        3,
                        $studentId
                    ), 
                    $filename
                );
            } else {
                // If no student selected, return with error
                return redirect()->back()->with('error', 'Please select a student to export');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export: ' . $e->getMessage());
        }
    }
}
