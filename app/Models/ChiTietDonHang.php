<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    // Khai báo các trường có thể được gán giá trị hàng loạt
    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'so_luong',
        'gia',
    ];

    // Khai báo quan hệ với mô hình DonHang
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    // Khai báo quan hệ với mô hình SanPham
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
