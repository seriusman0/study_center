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
            $table->foreignId('class_id')->nullable()->constrained()->onDelete('set null');
            
            // Structured journal fields
            $table->text('activities_today')->nullable();
            $table->text('learning_progress')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('solutions_applied')->nullable();
            $table->text('goals_tomorrow')->nullable();
            $table->text('additional_notes')->nullable();
            
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
            $table->index('class_id');
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
