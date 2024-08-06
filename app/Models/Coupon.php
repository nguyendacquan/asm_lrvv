<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'discount', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isValid()
    {
        return $this->expires_at ? $this->expires_at->isFuture() : true;
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_coupons')->withTimestamps();
    }
}
