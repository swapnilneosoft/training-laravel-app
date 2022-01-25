<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model
{
    use HasFactory;
    protected $fillable = [
        "coupon_id", "user_id", "order_id", "discounted_price"
    ];

    public function getCoupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
