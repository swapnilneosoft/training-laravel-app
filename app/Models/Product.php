<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductAssoc;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','description','price','quantity','category_id'
    ];

    public function getImages()
    {
        return $this->hasMany(ProductImage::class);
        // we need to add foreign id
    }

    public function getAssocAttr()
    {
        return $this->hasMany(ProductAssoc::class);
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getSubCategories()
    {
        // return $this->hasManyThrough(SubCategory::class,ProductCategory::class,'product_id','id');
        return $this->hasMany(ProductCategory::class);
    }






}
