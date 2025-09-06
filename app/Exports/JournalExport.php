<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Journal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

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
            // Order by user name then by entry date when fetching all journals
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
        if ($this->userId) {
            $user = User::find($this->userId);
            $studentName = $user ? $user->nama : 'Unknown';

            return [
                ['Laporan Jurnal Mingguan'],
                ['Nama Siswa: ' . $studentName],
                [],
                [
                    'Tanggal',
                    'Isi Jurnal',
                    'Status',
                ]
            ];
        }

        return [
            ['Laporan Jurnal Mingguan Semua Siswa'],
            [],
            [
                'Nama Siswa',
                'Tanggal',
                'Isi Jurnal',
                'Status',
            ]
        ];
    }

    /**
     * @param mixed $journal
     *
     * @return array
     */
    public function map($journal): array
    {
        if ($this->userId) {
            return [
                $journal->entry_date,
                strip_tags($journal->content),
                $journal->is_submitted ? 'Submitted' : 'Draft',
            ];
        }

        return [
            $journal->user->nama,
            $journal->entry_date,
            strip_tags($journal->content),
            $journal->is_submitted ? 'Submitted' : 'Draft',
        ];
    }
}
