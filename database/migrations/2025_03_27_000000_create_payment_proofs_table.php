<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_proofs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type'); // 'image' or 'pdf'
            $table->text('notes')->nullable();
            $table->string('period'); // Format: YYYY-MM
            $table->timestamps();

            $table->index('period');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_proofs');
    }
};
