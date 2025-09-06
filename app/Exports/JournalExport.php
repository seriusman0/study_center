<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Journal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JournalExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Journal::with('user')->orderBy('entry_date', 'desc');

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        } else {
            // Urutkan berdasarkan nama siswa, lalu tanggal
            $query->join('users', 'journals.user_id', '=', 'users.id')
                  ->orderBy('users.nama', 'asc')
                  ->orderBy('journals.entry_date', 'desc')
                  ->select('journals.*');
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $checklistHeadings = [
            'Mengawali Hari dengan Berdoa',
            'Baca Alkitab (PL)',
            'Baca Alkitab (PB)',
            'Hadir Kelas SC',
            'Hadir CSS',
            'Hadir CGG',
            'Merapikan Tempat Tidur',
            'Menyapa Orang Tua',
        ];

        if ($this->userId) {
            $user = User::find($this->userId);
            $studentName = $user ? $user->nama : 'Unknown';

            return [
                ['Laporan Jurnal Mingguan'],
                ['Nama Siswa: ' . $studentName],
                [],
                array_merge(
                    [
                        'Tanggal',
                        'Status',
                    ],
                    $checklistHeadings
                )
            ];
        }

        return [
            ['Laporan Jurnal Mingguan Semua Siswa'],
            [],
            array_merge(
                [
                    'Nama Siswa',
                    'Tanggal',
                    'Status',
                ],
                $checklistHeadings
            )
        ];
    }

    /**
     * @param mixed $journal
     *
     * @return array
     */
    public function map($journal): array
    {
        // Data checklist
        $checklistData = [
            $journal->mengawali_hari_dengan_berdoa ? 'Ya' : 'Tidak',
            $journal->baca_alkitab_pl ? 'Ya' : 'Tidak',
            $journal->baca_alkitab_pb ? 'Ya' : 'Tidak',
            $journal->hadir_kelas_sc ? 'Ya' : 'Tidak',
            $journal->hadir_css ? 'Ya' : 'Tidak',
            $journal->hadir_cgg ? 'Ya' : 'Tidak',
            $journal->merapikan_tempat_tidur ? 'Ya' : 'Tidak',
            $journal->menyapa_orang_tua ? 'Ya' : 'Tidak',
        ];

        if ($this->userId) {
            return array_merge(
                [
                    $journal->entry_date,
                    $journal->is_submitted ? 'Submitted' : 'Draft',
                ],
                $checklistData
            );
        }

        return array_merge(
            [
                $journal->user->nama,
                $journal->entry_date,
                $journal->is_submitted ? 'Submitted' : 'Draft',
            ],
            $checklistData
        );
    }
}