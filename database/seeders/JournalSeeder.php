<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Journal;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, handle User1 specifically to ensure 25 entries
        $user1 = User::where('username', 'user1')->first();
        
        if ($user1) {
            // Create exactly 25 entries for User1 in April 2025
            $dates = collect(CarbonPeriod::create('2025-04-01', '2025-04-30'))
                ->filter(fn ($date) => !$date->isWeekend()) // Skip weekends
                ->take(25); // Take exactly 25 days
            
            foreach ($dates as $date) {
                Journal::factory()
                    ->forUser($user1)
                    ->forDate($date)
                    ->create([
                        'is_submitted' => true,
                        'status' => 'submitted',
                        'submitted_at' => $date,
                        // Set all attendance fields to true for User1
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
        }

        // Then handle other active students with random entries
        $otherStudents = User::whereHas('studentDetail', function($query) {
            $query->where('is_active', true);
        })
        ->where('id', '!=', $user1?->id)
        ->get();

        $period = CarbonPeriod::create('2025-04-01', '2025-04-30');
        
        foreach ($otherStudents as $student) {
            foreach ($period as $date) {
                // Skip weekends
                if ($date->isWeekend()) {
                    continue;
                }

                // Create journal entry with 70% chance
                if (rand(1, 100) <= 70) {
                    Journal::factory()
                        ->forUser($student)
                        ->forDate($date)
                        ->create([
                            'is_submitted' => true,
                            'status' => 'submitted',
                            'submitted_at' => $date,
                        ]);
                }
            }
        }
    }
}
