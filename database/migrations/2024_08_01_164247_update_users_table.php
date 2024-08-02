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
            $table->string('hinh_anh')->nullable()->after('name');
            $table->enum('gioi_tinh', ['Nam', 'Nữ', 'Khác'])->default('Nam')->after('hinh_anh');
            $table->enum('trang_thai', ['Hoạt động', 'Không hoạt động'])->default('Hoạt động')->after('phone');
            $table->date('ngay_sinh')->nullable()->after('trang_thai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['hinh_anh', 'gioi_tinh', 'trang_thai', 'ngay_sinh']);
        });
    }
};
