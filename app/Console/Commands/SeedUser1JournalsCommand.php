<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\User1JournalSeeder;

class SeedUser1JournalsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:user1-journals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed 25 journal entries for User1 in April 2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to seed User1 journal entries...');
        
        $seeder = new User1JournalSeeder();
        $seeder->setCommand($this);
        $seeder->run();
        
        $this->info('User1 journal entries have been seeded successfully!');
    }
}
