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
            $table->text('journal_entry')->nullable()->after('attendance_percentage');
            $table->boolean('permission')->default(false)->after('journal_entry');
            $table->boolean('spr_father')->default(false)->after('permission');
            $table->boolean('spr_mother')->default(false)->after('spr_father');
            $table->boolean('spr_sibling')->default(false)->after('spr_mother');
            $table->decimal('total', 8, 2)->default(0)->after('spr_sibling');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_records', function (Blueprint $table) {
            $table->dropColumn([
                'journal_entry',
                'permission',
                'spr_father',
                'spr_mother',
                'spr_sibling',
                'total'
            ]);
        });
    }
};
