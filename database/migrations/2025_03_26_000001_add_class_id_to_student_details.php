<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First create the classes table if it doesn't exist
        if (!Schema::hasTable('classes')) {
            Schema::create('classes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('level');
                $table->string('section')->nullable();
                $table->string('academic_year');
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index('name');
                $table->index('is_active');
            });
        }

        // Then add class_id to student_details
        Schema::table('student_details', function (Blueprint $table) {
            if (!Schema::hasColumn('student_details', 'class_id')) {
                $table->foreignId('class_id')->nullable()->after('user_id')->constrained('classes')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            if (Schema::hasColumn('student_details', 'class_id')) {
                $table->dropForeign(['class_id']);
                $table->dropColumn('class_id');
            }
        });

        Schema::dropIfExists('classes');
    }
};
