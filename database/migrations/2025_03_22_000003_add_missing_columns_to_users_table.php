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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('batch_id');
            }
            if (!Schema::hasColumn('users', 'kelas')) {
                $table->string('kelas')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'timestamps')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'kelas']);
        });
    }
};
