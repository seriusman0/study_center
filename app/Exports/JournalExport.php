<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Journal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JournalExport implements FromCollection, WithHeadings, WithMapping
{
    protected ?int $userId;

    public function __construct(?int $userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        if ($this->userId) {
            return Journal::where('user_id', $this->userId)
                ->orderBy('entry_date', 'desc')
                ->get();
        }

        // Get all active students with their statistics
        return User::with([
            'journals' => function($query) {
                $query->where('created_at', '>=', now()->subMonth());
            },
            'attendanceRecords' => function($query) {
                $query->where('date', '>=', now()->subMonth());
            },
            'permissionRequests' => function($query) {
                $query->where('created_at', '>=', now()->subMonth());
            }
        ])
        ->active()
        ->get();
    }

    public function headings(): array
    {
        if ($this->userId) {
            return [
                'Tanggal',
                'Konten',
                'Status',
                'Dibuat Pada',
                'Diperbarui Pada'
            ];
        }

        return [
            'Nama Siswa',
            'Kelas',
            // Journal Statistics
            'Total Jurnal',
            'Jurnal Tersubmit',
            'Persentase Submission',
            // Attendance Statistics
            'Total Kehadiran',
            'Jumlah Hadir',
            'Persentase Kehadiran',
            // Permission Statistics
            'Total Izin',
            'Izin Disetujui',
            'Persentase Persetujuan'
        ];
    }

    public function map($record): array
    {
        if ($this->userId) {
            return [
                $record->entry_date->format('Y-m-d'),
                $record->content,
                $record->is_submitted ? 'Submitted' : 'Draft',
                $record->created_at->format('Y-m-d H:i:s'),
                $record->updated_at->format('Y-m-d H:i:s')
            ];
        }

        // Calculate statistics for each student
        $totalJournals = $record->journals->count();
        $submittedJournals = $record->journals->where('is_submitted', true)->count();
        
        $totalAttendance = $record->attendanceRecords->count();
        $presentAttendance = $record->attendanceRecords->where('status', 'present')->count();
        
        $totalPermissions = $record->permissionRequests->count();
        $approvedPermissions = $record->permissionRequests->where('status', 'approved')->count();

        return [
            $record->nama,
            $record->kelas,
            // Journal Statistics
            $totalJournals,
            $submittedJournals,
            $totalJournals > 0 ? number_format(($submittedJournals / $totalJournals) * 100, 1) . '%' : '0%',
            // Attendance Statistics
            $totalAttendance,
            $presentAttendance,
            $totalAttendance > 0 ? number_format(($presentAttendance / $totalAttendance) * 100, 1) . '%' : '0%',
            // Permission Statistics
            $totalPermissions,
            $approvedPermissions,
            $totalPermissions > 0 ? number_format(($approvedPermissions / $totalPermissions) * 100, 1) . '%' : '0%'
        ];
    }
}
