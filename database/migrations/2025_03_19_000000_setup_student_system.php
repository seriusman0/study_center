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
        if (!Schema::hasTable('student_details')) {
            Schema::create('student_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('address')->nullable();
                $table->string('phone')->nullable();
                $table->date('birth_date')->nullable();
                $table->string('birth_place')->nullable();
                $table->enum('gender', ['male', 'female'])->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index('user_id');
                $table->index('gender');
                $table->index('is_active');
            });
        }

        if (!Schema::hasTable('family_members')) {
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
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_details');
        Schema::dropIfExists('family_members');
    }
};
