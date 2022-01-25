<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\SubCategory;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'sub_category_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
