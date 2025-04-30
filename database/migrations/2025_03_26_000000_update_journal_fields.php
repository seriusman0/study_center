<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            // Drop existing content columns
            $table->dropColumn([
                'activities_today',
                'learning_progress',
                'challenges_faced',
                'solutions_applied',
                'goals_tomorrow',
                'additional_notes'
            ]);

            // Add new columns based on form
            $table->boolean('mengawali_hari_dengan_berdoa')->default(false);
            $table->boolean('baca_alkitab_pl')->default(false);
            $table->boolean('baca_alkitab_pb')->default(false);
            $table->boolean('hadir_kelas_sc')->default(false);
            $table->boolean('hadir_css')->default(false);
            $table->boolean('hadir_cgg')->default(false);
            $table->boolean('merapikan_tempat_tidur')->default(false);
            $table->boolean('menyapa_orang_tua')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            // Restore original columns
            $table->text('activities_today')->nullable();
            $table->text('learning_progress')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('solutions_applied')->nullable();
            $table->text('goals_tomorrow')->nullable();
            $table->text('additional_notes')->nullable();

            // Drop new columns
            $table->dropColumn([
                'mengawali_hari_dengan_berdoa',
                'baca_alkitab_pl',
                'baca_alkitab_pb',
                'hadir_kelas_sc',
                'hadir_css',
                'hadir_cgg',
                'merapikan_tempat_tidur',
                'menyapa_orang_tua'
            ]);
        });
    }
};
