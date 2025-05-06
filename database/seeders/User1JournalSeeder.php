<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Journal;
use App\Models\StudentDetail;
use Illuminate\Database\Seeder;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class User1JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or find User1
        $user1 = User::firstOrCreate(
            ['username' => 'user1'],
            [
                'nama' => 'User One',
                'email' => 'user1@example.com',
                'password' => bcrypt('password'),
            ]
        );

        // Create or update student details for User1
        StudentDetail::updateOrCreate(
            ['user_id' => $user1->id],
            [
                'is_active' => true,
                'gender' => 'male',
                'tingkat_kelas' => '7',
                'tahun_ajaran' => '2025',
            ]
        );

        // Delete any existing journals for User1 in April 2025
        Journal::where('user_id', $user1->id)
            ->whereBetween('entry_date', ['2025-04-01', '2025-04-30'])
            ->delete();

        // Get all dates in April 2025
        $allDates = collect(CarbonPeriod::create('2025-04-01', '2025-04-30'));
        
        // First get weekdays
        $weekdayDates = $allDates->filter(fn ($date) => !$date->isWeekend())->values();
        
        // If we don't have enough weekdays, include some weekend dates
        if ($weekdayDates->count() < 25) {
            $weekendDates = $allDates->filter(fn ($date) => $date->isWeekend())->values();
            $additionalDatesNeeded = 25 - $weekdayDates->count();
            $selectedDates = $weekdayDates->concat($weekendDates->take($additionalDatesNeeded));
        } else {
            $selectedDates = $weekdayDates->take(25);
        }

        // Create exactly 25 entries
        foreach ($selectedDates as $date) {
            Journal::factory()
                ->forUser($user1)
                ->forDate($date)
                ->create([
                    'is_submitted' => true,
                    'status' => 'submitted',
                    'submitted_at' => $date,
                    'mengawali_hari_dengan_berdoa' => true,
                    'baca_alkitab_pl' => true,
                    'baca_alkitab_pb' => true,
                    'hadir_kelas_sc' => true,
                    'hadir_css' => true,
                    'hadir_cgg' => true,
                    'merapikan_tempat_tidur' => true,
                    'menyapa_orang_tua' => true,
                ]);
        }

        // Verify count
        $finalCount = Journal::where('user_id', $user1->id)
            ->whereBetween('entry_date', ['2025-04-01', '2025-04-30'])
            ->count();

        $this->command->info("Created User1 with {$finalCount} journal entries for April 2025");
    }
}
