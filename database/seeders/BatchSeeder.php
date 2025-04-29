<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = [
            ['name' => 'Batch 1'],
            ['name' => 'Batch 2'],
            ['name' => 'Batch 3'],
        ];

        foreach ($batches as $batch) {
            Batch::updateOrCreate(
                ['name' => $batch['name']],
                $batch
            );
        }
    }
}
