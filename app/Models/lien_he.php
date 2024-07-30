<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lien_he extends Model
{
    use HasFactory;

    protected $fillable = ['ho_va_ten','so_dien_thoai','email','message','chu_de'];
}
