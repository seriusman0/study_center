<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('spp_amount', 10, 2);
            $table->decimal('scholarship_amount', 10, 2);
            $table->decimal('final_payment', 10, 2);
            $table->boolean('is_eligible')->default(true);
            $table->text('special_notes')->nullable();
            $table->timestamps();

            // Parent SPR (Surat Pernyataan Resmi)
            $table->boolean('father_spr_submitted')->default(false);
            $table->boolean('mother_spr_submitted')->default(false);
            $table->boolean('sibling_spr_submitted')->default(false);
            
            // Additional evaluation fields
            $table->string('language_class')->nullable();
            $table->string('robotics_class')->nullable();
            $table->text('evaluation_notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
