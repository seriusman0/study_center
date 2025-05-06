<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\PaymentProof;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class JournalStatistics extends Component
{
    use WithFileUploads;

    public $classRange = '7-9'; // Default value
    public $totalClasses = 3; // Default value
    public $selectedPeriod; // For storing selected period
    
    // Upload related properties
    public $selectedStudent = null;
    public $paymentFile;
    public $notes;
    public $showUploadModal = false;
    private const TOTAL_EXPECTED_JOURNALS = 25; // Total expected journals
    private const MAX_SPP_DEFAULT = 700000; // Maximum SPP default value
    
    protected $rules = [
        'paymentFile' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        // Set default period to current month and year
        $this->selectedPeriod = now()->format('Y-m');
    }

    public function openUploadModal($studentId)
    {
        $this->selectedStudent = $studentId;
        $this->resetUploadForm();
        $this->dispatch('openModal');
    }

    public function closeUploadModal()
    {
        $this->resetUploadForm();
        $this->dispatch('closeModal');
    }

    public function resetUploadForm()
    {
        $this->paymentFile = null;
        $this->notes = null;
        $this->resetValidation();
    }

    public function uploadPaymentProof()
    {
        $this->validate();

        try {
            $path = $this->paymentFile->store('payment-proofs', 'public');
            $fileType = $this->paymentFile->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image';

            PaymentProof::create([
                'user_id' => $this->selectedStudent,
                'file_path' => $path,
                'file_type' => $fileType,
                'notes' => $this->notes,
                'period' => $this->selectedPeriod
            ]);

            session()->flash('message', 'Payment proof uploaded successfully.');
            $this->closeUploadModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to upload payment proof. Please try again.');
        }
    }

    public function getPeriodsProperty()
    {
        $periods = [];
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Generate all months for the current year
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($currentYear, $month, 1);
            $periods[$date->format('Y-m')] = $date->format('F Y');
        }

        return $periods;
    }
    
    public function render()
    {
        // Parse class range
        $range = explode('-', $this->classRange);
        $minClass = (int) $range[0];
        $maxClass = (int) $range[1];

        // Parse selected period
        $periodStart = Carbon::createFromFormat('Y-m', $this->selectedPeriod)->startOfMonth();
        $periodEnd = $periodStart->copy()->endOfMonth();

        // Get active students with their related data and filter by class range
        $students = User::with([
            'journals' => function($query) use ($periodStart, $periodEnd) {
                $query->whereBetween('entry_date', [$periodStart, $periodEnd]);
            },
            'attendanceRecords' => function($query) use ($periodStart, $periodEnd) {
                $query->whereBetween('record_date', [$periodStart, $periodEnd]);
            },
            'permissionRequests' => function($query) use ($periodStart, $periodEnd) {
                $query->whereBetween('created_at', [$periodStart, $periodEnd]);
            },
            'studentDetail',
            'paymentProofs' => function($query) {
                $query->where('period', $this->selectedPeriod);
            }
        ])
        ->whereHas('studentDetail', function($query) use ($minClass, $maxClass) {
            $query->whereBetween('class', [$minClass, $maxClass]);
        })
        ->active()
        ->get()
        ->map(function($student) {
            // Journal statistics
            $submittedJournals = $student->journals->where('is_submitted', true)->count();
            $journalRate = ($submittedJournals / self::TOTAL_EXPECTED_JOURNALS) * 100;
            
            // Attendance statistics
            $regularAttendance = $student->attendanceRecords->sum('regular_attendance');
            $cssAttendance = $student->attendanceRecords->sum('css_attendance');
            $cggAttendance = $student->attendanceRecords->sum('cgg_attendance');
            $totalAttendance = $regularAttendance + $cssAttendance + $cggAttendance;
            
            // SPR Attendance statistics
            $sprFatherAttendance = $student->attendanceRecords->sum('spr_father');
            $sprMotherAttendance = $student->attendanceRecords->sum('spr_mother');
            $sprSiblingAttendance = $student->attendanceRecords->sum('spr_sibling');
            $totalSprAttendance = $sprFatherAttendance + $sprMotherAttendance + $sprSiblingAttendance;
            
            // Calculate attendance percentage based on total classes
            $attendancePercentage = $this->totalClasses > 0 
                ? ($totalAttendance / $this->totalClasses) * 100 
                : 0;
            
            // Permission statistics
            $totalPermissions = $student->permissionRequests->count();
            $approvedPermissions = $student->permissionRequests->where('status', 'approved')->count();

            // Calculate appreciation status
            $hasAppreciation = $journalRate >= 100 && 
                              $attendancePercentage >= 100 && 
                              $totalSprAttendance >= 4;

            // Calculate final payment based on conditions
            $finalPayment = null;
            if ($attendancePercentage >= 75) {
                if ($hasAppreciation) {
                    // For students with appreciation, use nominal_spp_default with max limit
                    $nominalSppDefault = (int) $student->studentDetail->nominal_spp_default;
                    $finalPayment = min($nominalSppDefault, self::MAX_SPP_DEFAULT);
                } else {
                    // For others with >= 75% attendance, use regular spp
                    $finalPayment = (int) $student->studentDetail->spp;
                }
            }

            return [
                'id' => $student->id,
                'nama' => $student->nama,
                'kelas' => $student->studentDetail->class ?? 'N/A',
                'spp' => $student->studentDetail->spp ?? 'N/A',
                // Journal metrics
                'submitted_journals' => $submittedJournals,
                'journal_submission_rate' => $journalRate,
                // Attendance metrics
                'regular_attendance' => $regularAttendance,
                'css_attendance' => $cssAttendance,
                'cgg_attendance' => $cggAttendance,
                'total_attendance' => $totalAttendance,
                'attendance_percentage' => $attendancePercentage,
                // SPR Attendance metrics
                'spr_father' => $sprFatherAttendance,
                'spr_mother' => $sprMotherAttendance,
                'spr_sibling' => $sprSiblingAttendance,
                'total_spr_attendance' => $totalSprAttendance,
                // Permission metrics
                'total_permissions' => $totalPermissions,
                'approved_permissions' => $approvedPermissions,
                'permission_approval_rate' => $totalPermissions > 0 ? ($approvedPermissions / $totalPermissions) * 100 : 0,
                // Appreciation status
                'has_appreciation' => $hasAppreciation,
                // Final payment
                'final_payment' => $finalPayment,
                'payment_proof' => $student->paymentProofs->first()
            ];
        });

        // Calculate overall statistics
        $overallStats = [
            'total_students' => $students->count(),
            'avg_journal_submission_rate' => $students->avg('journal_submission_rate'),
            'avg_attendance_percentage' => $students->avg('attendance_percentage'),
            'avg_permission_approval_rate' => $students->avg('permission_approval_rate'),
            'total_with_appreciation' => $students->where('has_appreciation', true)->count()
        ];

        return view('livewire.journal-statistics', [
            'students' => $students,
            'overallStats' => $overallStats,
            'periods' => $this->periods
        ]);
    }
}
