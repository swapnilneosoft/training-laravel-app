<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public $timestamps =false;

    protected $fillable=[
        "order_id","product_id","quantity","total_price"
    ];

    public function getOrder()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
