<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    protected $fillable = [
        'tieu_de',
        'hinh_anh',
        'noi_dung',
        'ngay_nhap',
        'san_pham_id'
    ];

    public function sanphamm()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
