<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AttendancePaymentExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithStartRow
{
    use Exportable;
    
    protected $classRange;
    protected $selectedPeriod;
    protected $totalClasses;
    protected $studentId; // For individual student exports
    protected $includeHeaders = true;
    protected const TOTAL_EXPECTED_JOURNALS = 25;
    protected const MAX_SPP_DEFAULT = 700000;

    public function __construct($classRange = '7-9', $selectedPeriod = null, $totalClasses = 3, $studentId = null, $includeHeaders = true)
    {
        $this->classRange = $classRange;
        $this->selectedPeriod = $selectedPeriod ?? now()->format('Y-m');
        $this->totalClasses = $totalClasses;
        $this->studentId = $studentId;
        $this->includeHeaders = $includeHeaders;
    }

    public function startRow(): int
    {
        return 6;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Parse selected period
        $periodStart = Carbon::createFromFormat('Y-m', $this->selectedPeriod)->startOfMonth();
        $periodEnd = $periodStart->copy()->endOfMonth();

        // Format the period for display
        $periodName = $periodStart->format('F Y');

        // Base query with relations
        $query = User::with([
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
        ]);

        // If specific student ID is provided, get only that student
        if ($this->studentId) {
            $query->where('id', $this->studentId);
        } else {
            // Otherwise, get all students in the class range
            $range = explode('-', $this->classRange);
            $minClass = (int) $range[0];
            $maxClass = (int) $range[1];
            
            $query->whereHas('studentDetail', function($query) use ($minClass, $maxClass) {
                $query->whereBetween('class', [$minClass, $maxClass]);
            });
        }

        return $query->active()->get();
    }

    public function headings(): array
    {
        // If we don't want headers (for importing), return empty array
        if (!$this->includeHeaders) {
            return [];
        }
        
        return [
            ['Bln', 'Bin', 'SPP', '', 'Hadir Reg', 'Hadir CSS', 'Hadir CGG', '%', '', 'Total Kel. Mendampingi', 'Isi Jurnal', 'Izin'],
        ];
    }

    public function map($student): array
    {
        try {
            // Parse selected period
            $periodStart = Carbon::createFromFormat('Y-m', $this->selectedPeriod)->startOfMonth();
            $periodEnd = $periodStart->copy()->endOfMonth();
            
            // Journal statistics
            $submittedJournals = $student->journals->where('is_submitted', true)->count();
            
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
            
            // Calculate appreciation status
            $journalRate = ($submittedJournals / self::TOTAL_EXPECTED_JOURNALS) * 100;
            $hasAppreciation = $journalRate >= 100 && $attendancePercentage >= 100 && $totalSprAttendance >= 4;
            
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
            
            // Get month number (formatted as 2 digits) for the "Bulan" column
            $monthNumber = $periodStart->format('m');
            
            return [
                $monthNumber,  // Month number (09 for September)
                'BATCH ' . ($student->studentDetail->batch ?? 'N/A'), 
                $finalPayment ?? 0, // SPP as numeric value
                '', // Empty column
                $regularAttendance, 
                $cssAttendance,
                $cggAttendance,
                number_format($attendancePercentage, 2), // Percentage without % sign
                '', // Empty column
                $totalSprAttendance,
                $submittedJournals,
                $totalPermissions
            ];
        } catch (\Exception $e) {
            // Log error but don't stop the process
            Log::error('Error generating export row for student ID: ' . $student->id . ': ' . $e->getMessage());
            
            // Return a row with default values
            return [
                Carbon::now()->format('m'), // Current month
                'ERROR', 
                0, 
                '', 
                0, 
                0, 
                0, 
                '0.00',
                '',
                0,
                0,
                0
            ];
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                try {
                    $sheet = $event->sheet;
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();
                    
                    // If we're working with a specific student, let's get their data
                    $student = null;
                    if ($this->studentId) {
                        $student = User::with('studentDetail')->find($this->studentId);
                    }
    
                    // Row 1-4: Student info
                    $sheet->setCellValue('A1', 'Nama');
                    if ($student) {
                        $sheet->setCellValue('C1', $student->nama);
                    } else {
                        $sheet->setCellValue('C1', 'Rekap Gabungan');
                    }
                    $sheet->setCellValue('H1', 'Tanggal :');
                    $sheet->setCellValue('J1', Carbon::now()->format('d-M-Y'));
                    
                    $sheet->setCellValue('A2', 'Kelas');
                    if ($student) {
                        $sheet->setCellValue('C2', 'BATCH ' . ($student->studentDetail->batch ?? 'N/A'));
                    } else {
                        $sheet->setCellValue('C2', 'BATCH ' . $this->classRange);
                    }
                    
                    $sheet->setCellValue('A3', 'NIS');
                    if ($student) {
                        $sheet->setCellValue('C3', $student->nip ?? 'N/A');
                    } else {
                        $sheet->setCellValue('C3', Carbon::createFromFormat('Y-m', $this->selectedPeriod)->format('F Y'));
                    }
                    
                    $sheet->setCellValue('A4', 'Sekolah');
                    if ($student) {
                        $sheet->setCellValue('C4', $student->studentDetail->sekolah ?? 'N/A');
                    } else {
                        $sheet->setCellValue('C4', 'Study Center Gunung Sahari');
                    }
    
                    // Row 6: Header for the attendance table (already included in headings)
                    
                    // Set the style for row 6 (headers)
                    $sheet->getStyle('A6:L6')->applyFromArray([
                        'font' => [
                            'bold' => true,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);
    
                    // Add borders to all data cells
                    $dataLastRow = ($highestRow > 6) ? $highestRow : 7; // Ensure we have at least one data row
                    $sheet->getStyle('A6:L' . $dataLastRow)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                    
                    // Row 10: Catatan dari SCGS
                    $catatanRow = max($dataLastRow + 2, 10);
                    $sheet->setCellValue('A' . $catatanRow, 'Catatan dari SCGS:');
                    $sheet->getStyle('A' . $catatanRow)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF00FFFF');
                    
                    // Box for notes (3 rows tall)
                    $sheet->mergeCells('A' . ($catatanRow + 1) . ':L' . ($catatanRow + 3));
                    $sheet->getStyle('A' . ($catatanRow + 1) . ':L' . ($catatanRow + 3))->applyFromArray([
                        'borders' => [
                            'outline' => [
                                'borderStyle' => Border::BORDER_MEDIUM,
                                'color' => ['argb' => 'FFFF00FF'],
                            ],
                        ],
                    ]);
                    
                    // Row 13-15: Tagihan, Pembayaran, Sisa
                    $tagihRow = $catatanRow + 5;
                    $sheet->setCellValue('A' . $tagihRow, 'Tagihan dari Sekolah');
                    $sheet->setCellValue('C' . $tagihRow, '=SUM(D7:D' . $dataLastRow . ')');
                    
                    $sheet->setCellValue('A' . ($tagihRow + 1), 'Pembayaran dari SCGS');
                    $sheet->setCellValue('C' . ($tagihRow + 1), '=SUM(C7:C' . $dataLastRow . ')');
                    
                    $sheet->setCellValue('A' . ($tagihRow + 2), 'Sisa Pembayaran');
                    $sheet->setCellValue('C' . ($tagihRow + 2), '=C' . $tagihRow . '-C' . ($tagihRow + 1));
                    
                    // Row 18: Rincian pembayaran
                    $rincianRow = $tagihRow + 5;
                    $sheet->setCellValue('A' . $rincianRow, 'Rincian Pembayaran');
                    $sheet->getStyle('A' . $rincianRow)->getFont()->setBold(true);
                    
                    $sheet->setCellValue('A' . ($rincianRow + 1), 'Tanggal');
                    $sheet->setCellValue('B' . ($rincianRow + 1), 'Jumlah (Rp)');
                    $sheet->setCellValue('C' . ($rincianRow + 1), 'Kode Bayar');
                    $sheet->setCellValue('D' . ($rincianRow + 1), 'Kerangan');
                    
                    // Example payment entry
                    $sheet->setCellValue('A' . ($rincianRow + 2), Carbon::now()->format('d-M-Y'));
                    $sheet->setCellValue('B' . ($rincianRow + 2), '=C' . ($tagihRow + 1)); // Equal to "Pembayaran dari SCGS"
                    $sheet->setCellValue('C' . ($rincianRow + 2), 'SPP');
                    
                    // Add borders to the payment details
                    $sheet->getStyle('A' . ($rincianRow + 1) . ':D' . ($rincianRow + 2))->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                    
                    // Format the currency cells
                    $sheet->getStyle('C7:C' . $dataLastRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('C' . $tagihRow . ':C' . ($tagihRow + 2))->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('B' . ($rincianRow + 2))->getNumberFormat()->setFormatCode('#,##0');
                    
                    // Format percentage cells
                    $sheet->getStyle('H7:H' . $dataLastRow)->getNumberFormat()->setFormatCode('0.00"%"');
                } catch (\Exception $e) {
                    Log::error('Error in Excel export styling: ' . $e->getMessage());
                }
            },
        ];
    }
}
