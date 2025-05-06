<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\JournalSeeder;
use App\Models\Journal;

class SeedJournalsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:journals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed journal entries for April 2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to seed journal entries...');
        
        // Clear existing journals first using delete instead of truncate
        $this->info('Clearing existing journals...');
        Journal::query()->delete();
        
        // Run the journal seeder
        $this->info('Creating new journal entries...');
        $seeder = new JournalSeeder();
        $seeder->run();
        
        $this->info('Journal entries have been seeded successfully!');
    }
}
