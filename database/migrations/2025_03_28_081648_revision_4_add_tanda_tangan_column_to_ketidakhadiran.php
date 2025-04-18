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
        Schema::table('ketidakhadirans', function (Blueprint $table) {
            $table->string('signature')->nullable()->after('approved_by_hcm');
            $table->string('signature_hcm')->nullable()->after('signature');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ketidakhadirans', function (Blueprint $table) {
            $table->dropColumn('signature'); // Rollback if needed
            $table->dropColumn('signature_hcm');
        });
    }
};
