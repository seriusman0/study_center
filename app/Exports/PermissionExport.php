<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\PermissionRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PermissionExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithTitle, WithStyles
{
    protected $month;
    protected $year;

    public function __construct($month = null, $year = null)
    {
        $this->month = $month ?: now()->month;
        $this->year = $year ?: now()->year;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Start of the month
        $startDate = Carbon::createFromDate($this->year, $this->month, 1)->startOfDay();
        // End of the month
        $endDate = $startDate->copy()->endOfMonth()->endOfDay();
        
        // Query for permission requests for the current month
        return PermissionRequest::with('user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $monthName = Carbon::createFromDate($this->year, $this->month, 1)->translatedFormat('F Y');
        
        return [
            ['Laporan Izin Bulan ' . $monthName],
            ['Tanggal Export: ' . now()->format('d-m-Y H:i')],
            [],
            [
                'Tanggal',
                'Nama Siswa',
                'NIP',
                'Jenis Kelas',
                'Status',
                'Alasan',
                'Tanggal Pengajuan',
                'Tanggal Diproses',
            ]
        ];
    }

    /**
     * @param mixed $request
     *
     * @return array
     */
    public function map($request): array
    {
        return [
            $request->date->format('d-m-Y'),
            $request->user->nama,
            $request->user->nip,
            strtoupper($request->class_type),
            ucfirst($request->status),
            $request->reason ?? '-',
            $request->created_at->format('d-m-Y H:i'),
            $request->updated_at->format('d-m-Y H:i'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $monthName = Carbon::createFromDate($this->year, $this->month, 1)->translatedFormat('F Y');
        return 'Laporan Izin ' . $monthName;
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Style for the title (first row)
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
        ]);
        
        // Style for the date (second row)
        $sheet->getStyle('A2:H2')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
        ]);
        
        // Style for the header row
        $sheet->getStyle('A4:H4')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'DDDDDD',
                ],
            ],
        ]);
        
        // Auto filter for header
        $sheet->setAutoFilter('A4:H4');
    }
}
