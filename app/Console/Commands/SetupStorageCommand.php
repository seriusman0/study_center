<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SetupStorageCommand extends Command
{
    protected $signature = 'storage:setup';
    protected $description = 'Setup storage directories and permissions for file uploads';

    public function handle()
    {
        $this->info('Setting up storage directories...');

        // Create storage link if it doesn't exist
        if (!file_exists(public_path('storage'))) {
            $this->call('storage:link');
        }

        // Create payment_proofs directory
        $paymentProofsPath = Storage::disk('public')->path('payment_proofs');
        if (!file_exists($paymentProofsPath)) {
            mkdir($paymentProofsPath, 0755, true);
            $this->info('Created payment_proofs directory');
        }

        // Set proper permissions
        chmod($paymentProofsPath, 0755);
        $this->info('Set permissions for payment_proofs directory');

        $this->info('Storage setup completed successfully!');
        $this->info('You can now upload payment proofs.');
    }
}
