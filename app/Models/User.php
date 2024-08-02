<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const  ROLE_ADMIN = 'Admin';
    const  ROLE_USER = 'User';

  

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'hinh_anh',
        'gioi_tinh',
        'trang_thai',
        'ngay_sinh',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    protected $dates = ['deleted_at']; 

    public function donHang()
    {
        return $this->hasMany(DonHang::class);
    }
<<<<<<< HEAD
    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'nguoi_dung_id');
    }
=======
    use SoftDeletes;
>>>>>>> 285adfb10da2525062d75de76ac4f0f9ee8fc85d
}
