<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUser1JournalsCommand extends Command
{
    protected $signature = 'check:user1-journals';
    protected $description = 'Check User1 journal entries for April 2025';

    public function handle()
    {
        $user = User::where('username', 'user1')->first();
        
        if (!$user) {
            $this->error('User1 not found!');
            return;
        }

        $journals = $user->journals()
            ->whereBetween('entry_date', ['2025-04-01', '2025-04-30'])
            ->orderBy('entry_date')
            ->get();

        $this->info('Total Journals: ' . $journals->count());
        $this->info('Journal Dates:');
        
        foreach ($journals as $journal) {
            $this->line($journal->entry_date);
        }
    }
}
