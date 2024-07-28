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
        Schema::table('lien_hes', function (Blueprint $table) {
            //
            $table->string('so_dien_thoai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lien_hes', function (Blueprint $table) {
            //
            $table->dropColumn('so_dien_thoai');
        });
    }
};
