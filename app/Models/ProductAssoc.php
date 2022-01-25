<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductAssoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'attr_name', 'attr_description'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
