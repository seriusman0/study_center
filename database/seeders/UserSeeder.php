<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create user 1
        $userId1 = DB::table('users')->insertGetId([
            'nama' => 'User One',
            'nip' => '12345678',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('user1'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create student details for user 1
        DB::table('student_details')->insert([
            'user_id' => $userId1,
            'address' => 'Sample Address 1',
            'phone' => '1234567890',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Sample City',
            'gender' => 'male',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create attendance record for user 1
        DB::table('attendance_records')->insert([
            'user_id' => $userId1,
            'regular_attendance' => 0,
            'css_attendance' => 0,
            'cgg_attendance' => 0,
            'spr_father' => 0,
            'spr_mother' => 0,
            'spr_sibling' => 0,
            'record_date' => now(),
            'notes' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create user 2
        $userId2 = DB::table('users')->insertGetId([
            'nama' => 'User Two',
            'nip' => '87654321',
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('user2'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create student details for user 2
        DB::table('student_details')->insert([
            'user_id' => $userId2,
            'address' => 'Sample Address 2',
            'phone' => '0987654321',
            'birth_date' => '2001-02-02',
            'birth_place' => 'Sample City 2',
            'gender' => 'female',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create attendance record for user 2
        DB::table('attendance_records')->insert([
            'user_id' => $userId2,
            'regular_attendance' => 0,
            'css_attendance' => 0,
            'cgg_attendance' => 0,
            'spr_father' => 0,
            'spr_mother' => 0,
            'spr_sibling' => 0,
            'record_date' => now(),
            'notes' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
