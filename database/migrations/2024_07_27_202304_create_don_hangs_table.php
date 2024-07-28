<?php

use App\Models\User;
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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained(); // Khóa ngoại liên kết với bảng users
            $table->timestamp('ngay_dat_hang')->useCurrent();
            $table->enum('trang_thai', ['Đang xử lý', 'Đã giao', 'Hủy'])->default('Đang xử lý');
            $table->double('tong_tien');
            $table->text('dia_chi_giao_hang')->nullable();
            $table->enum('phuong_thuc_thanh_toan', ['Chuyển khoản', 'COD'])->default('COD');
            $table->double('chi_phi_van_chuyen')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
