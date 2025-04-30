<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            // Drop existing content column to restructure
            $table->dropColumn('content');
            
            // Add form fields based on Google Form
            $table->text('activities_today')->nullable();
            $table->text('learning_progress')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('solutions_applied')->nullable();
            $table->text('goals_tomorrow')->nullable();
            $table->text('additional_notes')->nullable();
            
            // Add selfie image field
            $table->string('selfie_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            // Restore original content column
            $table->text('content')->nullable();
            
            // Remove new columns
            $table->dropColumn([
                'activities_today',
                'learning_progress',
                'challenges_faced',
                'solutions_applied',
                'goals_tomorrow',
                'additional_notes',
                'selfie_image'
            ]);
        });
    }
};
