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
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('gender');
        });

        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('relationship', ['father', 'mother', 'sibling', 'other']);
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('member_ids')->nullable(); // For storing multiple IDs
            $table->timestamps();

            $table->index('user_id');
            $table->index('relationship');
            $table->index('name');
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('level');
            $table->string('section');
            $table->string('academic_year');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('batch_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index('batch_id');
            $table->index('code');
            $table->index('academic_year');
            $table->index('is_active');
            $table->unique(['name', 'academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
        Schema::dropIfExists('family_members');
        Schema::dropIfExists('student_details');
    }
};
