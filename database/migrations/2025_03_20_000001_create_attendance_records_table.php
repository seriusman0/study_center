<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('regular_attendance')->default(0);
            $table->integer('css_attendance')->default(0);
            $table->integer('cgg_attendance')->default(0);
            $table->integer('total_sessions')->default(0);
            $table->decimal('attendance_percentage', 5, 2)->default(0);
            $table->integer('excused_absences')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
