<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add new columns to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('nama');
            $table->string('kelas')->nullable()->after('gender');
        });

        // Update student_details table
        Schema::table('student_details', function (Blueprint $table) {
            // Add bank information fields
            $table->string('nama_bank')->nullable()->after('no_rekening');
            $table->string('cabang_bank')->nullable()->after('nama_bank');
            $table->string('pemilik_rekening')->nullable()->after('cabang_bank');
            
            // Add academic fields
            $table->string('tingkat_kelas')->nullable();
            $table->string('tahun_ajaran')->nullable();
            
            // Add additional fields for scholarship
            $table->decimal('nominal_spp_default', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'kelas']);
        });

        Schema::table('student_details', function (Blueprint $table) {
            $table->dropColumn([
                'nama_bank',
                'cabang_bank',
                'pemilik_rekening',
                'tingkat_kelas',
                'tahun_ajaran',
                'nominal_spp_default',
                'is_active'
            ]);
        });
    }
};
