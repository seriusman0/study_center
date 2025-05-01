<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Create user
        $userId = DB::table('users')->insertGetId([
            'nama' => 'Student User',
            'nip' => '12345678',
            'username' => 'student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'batch_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create student details
        DB::table('student_details')->insert([
            'user_id' => $userId,
            'address' => 'Sample Address',
            'phone' => '1234567890',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Sample City',
            'gender' => 'male',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create attendance record
        DB::table('attendance_records')->insert([
            'user_id' => $userId,
            'class_id' => 1,
            'regular_attendance' => 0,
            'css_attendance' => 0,
            'cgg_attendance' => 0,
            'excused_absences' => 0,
            'journal_entry' => 0,
            'record_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
