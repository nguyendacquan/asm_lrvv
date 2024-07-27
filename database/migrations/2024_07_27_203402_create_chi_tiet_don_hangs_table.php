<?php

use App\Models\DonHang;
use App\Models\SanPham;
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
        Schema::create('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DonHang::class)->constrained(); // Khóa ngoại liên kết với bảng don_hangs
            $table->foreignIdFor(SanPham::class)->constrained(); // Khóa ngoại liên kết với bảng san_phams
            $table->unsignedInteger('so_luong');
            $table->double('gia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_don_hangs');
    }
};
