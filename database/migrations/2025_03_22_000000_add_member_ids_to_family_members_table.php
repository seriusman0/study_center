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
        Schema::table('family_members', function (Blueprint $table) {
            // Add member_id field after nama
            $table->string('member_id')->nullable()->after('nama');
            
            // Add index to member_id for better query performance
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
            $table->dropColumn('member_id');
        });
    }
};
