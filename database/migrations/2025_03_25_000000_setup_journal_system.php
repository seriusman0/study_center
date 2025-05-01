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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Structured journal fields
            $table->boolean('mengawali_hari_dengan_berdoa')->default(false);
            $table->boolean('baca_alkitab_pl')->default(false);
            $table->boolean('baca_alkitab_pb')->default(false);
            $table->boolean('hadir_kelas_sc')->default(false);
            $table->boolean('hadir_css')->default(false);
            $table->boolean('hadir_cgg')->default(false);
            $table->boolean('merapikan_tempat_tidur')->default(false);
            $table->boolean('menyapa_orang_tua')->default(false);
            $table->boolean('is_submitted')->default(false);
            
            // Media
            $table->string('selfie_image')->nullable();
            $table->json('attachments')->nullable();
            
            // Metadata
            $table->date('entry_date');
            $table->enum('status', ['draft', 'submitted', 'reviewed'])->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('user_id');
            $table->index('entry_date');
            $table->index('status');
            $table->unique(['user_id', 'entry_date']);
        });

        Schema::create('journal_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('set null');
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();

            $table->index('journal_id');
            $table->index(['user_id', 'admin_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_comments');
        Schema::dropIfExists('journals');
    }
};
