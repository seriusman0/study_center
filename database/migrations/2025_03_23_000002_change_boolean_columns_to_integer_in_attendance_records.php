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
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->integer('permission')->default(0)->change();
            $table->integer('spr_father')->default(0)->change();
            $table->integer('spr_mother')->default(0)->change();
            $table->integer('spr_sibling')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->boolean('permission')->default(false)->change();
            $table->boolean('spr_father')->default(false)->change();
            $table->boolean('spr_mother')->default(false)->change();
            $table->boolean('spr_sibling')->default(false)->change();
        });
    }
};
