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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Attendance counts (using integers instead of booleans)
            $table->integer('regular_attendance')->default(0);
            $table->integer('css_attendance')->default(0);
            $table->integer('cgg_attendance')->default(0);
            // Removed excused_absences column as it will be calculated dynamically
            
            // Journal entry tracking
            $table->integer('journal_entry')->default(0);
            $table->integer('permission')->default(0);
            $table->integer('spr_father')->default(0);
            $table->integer('spr_mother')->default(0);
            $table->integer('spr_sibling')->default(0);
            
            // Metadata
            $table->date('record_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for frequent queries
            $table->index('user_id');
            $table->index('record_date');
            $table->unique(['user_id', 'record_date']);
        });

        Schema::create('sessions_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('session_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('type', ['regular', 'css', 'cgg'])->default('regular');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('session_date');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions_attendance');
        Schema::dropIfExists('attendance_records');
    }
};
