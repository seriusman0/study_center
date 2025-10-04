<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DebugUsers extends Command
{
    protected $signature = 'debug:users';
    protected $description = 'Debug users in system';

    public function handle()
    {
        $this->info("=== All Users in System ===");
        
        $users = User::with('journals')->get();
        
        foreach ($users as $user) {
            $this->info("ID: {$user->id} | Name: {$user->nama} | Email: {$user->email} | Username: {$user->username} | Journals: {$user->journals->count()}");
        }
        
        $this->info("\n=== Users with Most Journals ===");
        $topUsers = User::withCount('journals')
            ->orderBy('journals_count', 'desc')
            ->take(5)
            ->get();
            
        foreach ($topUsers as $user) {
            $this->info("Name: {$user->nama} (ID: {$user->id}) - {$user->journals_count} journals");
        }
    }
}