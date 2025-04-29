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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Add some default batches
        DB::table('batches')->insert([
            ['name' => 'Batch 1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Batch 2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Batch 3', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
