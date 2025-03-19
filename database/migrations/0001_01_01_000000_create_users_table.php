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
        // Buat tabel batches untuk menyimpan informasi batch
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama batch
            $table->timestamps();
        });

        // Perbarui tabel users untuk menambahkan hubungan ke tabel batches
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->foreignId('batch_id')->constrained('batches')->onDelete('cascade'); // Menambahkan foreign key ke tabel batches
        });

        // Menghapus tabel password_reset_tokens dan sessions karena tidak diperlukan
        // dalam struktur sederhana ini
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel users terlebih dahulu karena tergantung pada tabel batches
        Schema::dropIfExists('users');
        Schema::dropIfExists('batches');
    }
};