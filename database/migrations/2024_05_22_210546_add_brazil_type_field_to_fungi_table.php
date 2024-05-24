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
        Schema::table('fungi', function (Blueprint $table) {
            $table->char('brazilian_type', 1)->nullable();
            $table->char('brazilian_type_synonym', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fungi', function (Blueprint $table) {
            $table->dropColumn('brazilian_type');
            $table->dropColumn('brazilian_type_synonym');
        });
    }
};
