<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'Kelas 10A',
                'level' => '10',
                'section' => 'A',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas 10B',
                'level' => '10',
                'section' => 'B',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas 11A',
                'level' => '11',
                'section' => 'A',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas 11B',
                'level' => '11',
                'section' => 'B',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas 12A',
                'level' => '12',
                'section' => 'A',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
            [
                'name' => 'Kelas 12B',
                'level' => '12',
                'section' => 'B',
                'academic_year' => '2023/2024',
                'is_active' => true,
            ],
        ];

        foreach ($classes as $class) {
            ClassRoom::updateOrCreate(
                [
                    'name' => $class['name'], 
                    'academic_year' => $class['academic_year'],
                    'code' => strtolower(str_replace(' ', '-', $class['name'])) . '-' . str_replace('/', '-', $class['academic_year'])
                ],
                array_merge($class, [
                    'batch_id' => 1, // Default to first batch
                    'code' => strtolower(str_replace(' ', '-', $class['name'])) . '-' . str_replace('/', '-', $class['academic_year'])
                ])
            );
        }
    }
}
