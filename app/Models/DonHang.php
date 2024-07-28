<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    // Khai báo các trường có thể được gán giá trị hàng loạt
    protected $fillable = [
        'user_id',
        'ngay_dat_hang',
        'trang_thai',
        'tong_tien',
        'dia_chi_giao_hang',
        'phuong_thuc_thanh_toan',
        'chi_phi_van_chuyen',
    ];

    // Khai báo quan hệ với mô hình User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Khai báo quan hệ với mô hình ChiTietDonHang
    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class);
    }
}
