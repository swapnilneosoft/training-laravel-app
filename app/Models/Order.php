<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAddress;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "address_id", "amount", "payment_mode", "payment_status", "payment_id", "transaction_id", "coupon_used", "status"
    ];

    public function getAddress()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
