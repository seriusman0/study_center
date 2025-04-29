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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level'); // e.g., '10', '11', '12'
            $table->string('section')->nullable(); // e.g., 'A', 'B', 'C'
            $table->string('academic_year');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add class_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('class_id')->nullable()->after('batch_id')
                  ->constrained('classes')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
        
        Schema::dropIfExists('classes');
    }
};
