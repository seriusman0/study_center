<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Journal;
use App\Models\User;

class DebugJournal extends Command
{
    protected $signature = 'debug:journal {id}';
    protected $description = 'Debug journal access issues';

    public function handle()
    {
        $id = $this->argument('id');
        
        $this->info("=== Debugging Journal ID {$id} ===");
        
        $journal = Journal::find($id);
        
        if (!$journal) {
            $this->error("Journal with ID {$id} not found!");
            return;
        }
        
        $this->info("✅ Journal found!");
        $this->info("Journal ID: {$journal->id}");
        $this->info("User ID: {$journal->user_id}");
        $this->info("Entry Date: {$journal->entry_date}");
        $this->info("Is Submitted: " . ($journal->is_submitted ? 'Yes' : 'No'));
        
        $user = $journal->user;
        if ($user) {
            $this->info("User Name: {$user->nama}");
            $this->info("User Email: {$user->email}");
            $this->info("User Username: {$user->username}");
        } else {
            $this->error("❌ User not found for this journal!");
        }
        
        // Show all users with journals
        $this->info("\n👥 Users with journals:");
        $users = User::whereHas('journals')->with('journals')->take(5)->get();
        foreach ($users as $user) {
            $this->info("User: {$user->nama} (ID: {$user->id}) - Journals: {$user->journals->count()}");
        }
    }
}