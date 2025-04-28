<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Scholarship;
use App\Models\AttendanceRecord;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ScholarshipController extends Controller
{
    /**
     * Display scholarship management dashboard
     */
    public function index()
    {
        $students = User::with([
            'studentDetail',
            'scholarship',
            'attendanceRecord',
            'familyMembers',
            'journals'
        ])->active()->paginate(15);

        return view('admin.scholarships.index', compact('students'));
    }

    /**
     * Show individual student scholarship details
     */
    public function show(User $user)
    {
        $user->load([
            'studentDetail',
            'scholarship',
            'attendanceRecord',
            'familyMembers',
            'journals' => function($q) {
                $q->latest()->take(10);
            }
        ]);

        return view('admin.scholarships.show', compact('user'));
    }

    /**
     * Update scholarship calculation
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'spp_amount' => 'required|numeric|min:0',
            'special_notes' => 'nullable|string',
            'father_spr_submitted' => 'boolean',
            'mother_spr_submitted' => 'boolean',
            'sibling_spr_submitted' => 'boolean',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $scholarship = $user->scholarship ?? new Scholarship(['user_id' => $user->id]);
            $scholarship->fill($validated);
            $scholarship->save();
            $scholarship->calculateScholarship();
        });

        return redirect()->route('admin.scholarships.show', $user)
            ->with('success', 'Data beasiswa berhasil diperbarui');
    }

    /**
     * Import scholarship data from Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $file = $request->file('file');
                
                // Process REPORT sheet
                $reportData = Excel::toCollection(null, $file, null, 'REPORT')[0];
                foreach ($reportData as $row) {
                    if (!isset($row['id']) || !$row['id']) continue;

                    $user = User::where('nip', $row['id'])->first();
                    if (!$user) continue;

                    // Update attendance
                    $attendance = $user->attendanceRecord ?? new AttendanceRecord(['user_id' => $user->id]);
                    $attendance->fill([
                        'regular_attendance' => $row['hadir_reguler'] ?? 0,
                        'css_attendance' => $row['hadir_css'] ?? 0,
                        'cgg_attendance' => $row['hadir_cgg'] ?? 0,
                        'total_sessions' => 100, // Assuming 100 total sessions
                        'excused_absences' => $row['izin'] ?? 0
                    ]);
                    $attendance->save();
                    $attendance->calculateAttendancePercentage();

                    // Update user details
                    $user->update([
                        'gender' => $row['gender'],
                        'kelas' => $row['kelas']
                    ]);
                }

                // Process DATA UTAMA sheet
                $mainData = Excel::toCollection(null, $file, null, 'DATA UTAMA')[0];
                foreach ($mainData as $row) {
                    if (!isset($row['id']) || !$row['id']) continue;

                    $user = User::where('nip', $row['id'])->first();
                    if (!$user) continue;

                    // Update scholarship
                    $scholarship = $user->scholarship ?? new Scholarship(['user_id' => $user->id]);
                    $scholarship->fill([
                        'spp_amount' => $row['nominal_spp'] ?? 0,
                        'father_spr_submitted' => $row['spr_ayah'] ?? false,
                        'mother_spr_submitted' => $row['spr_ibu'] ?? false,
                        'sibling_spr_submitted' => $row['spr_saudara'] ?? false,
                        'special_notes' => $row['catatan_khusus']
                    ]);
                    $scholarship->save();
                    $scholarship->calculateScholarship();

                    // Update student details
                    $studentDetail = $user->studentDetail;
                    if ($studentDetail) {
                        $studentDetail->update([
                            'sekolah' => $row['sekolah'],
                            'spp' => $row['nominal_spp'],
                            'no_rekening' => $row['rekening'],
                            'nominal_spp_default' => $row['nominal_spp']
                        ]);
                    }
                }
            });

            return redirect()->route('admin.scholarships.index')
                ->with('success', 'Data beasiswa berhasil diimpor');
        } catch (\Exception $e) {
            return redirect()->route('admin.scholarships.index')
                ->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    /**
     * Export scholarship report
     */
    public function export()
    {
        $students = User::with([
            'studentDetail',
            'scholarship',
            'attendanceRecord',
            'familyMembers'
        ])->active()->get();

        // Implementation for export functionality
        // You'll need to create an Excel export class

        return redirect()->route('admin.scholarships.index')
            ->with('success', 'Laporan beasiswa berhasil diekspor');
    }
}
