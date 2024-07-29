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
            //
            $table->string('hinh_anh')->nullable()->after('id');
            $table->enum('gioi_tinh', ['Nam', 'Nữ', 'Khác'])->default('Nam')->after('email');
            $table->boolean('trang_thai')->default(true)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('hinh_anh');
            $table->dropColumn('gioi_tinh');
            $table->dropColumn('trang_thai');
        });
    }
};
