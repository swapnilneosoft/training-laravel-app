<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable=[
        'image_url','product_id'
    ];

    protected $hidden=['created_at','updated_at'];

    public function getProduct()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
