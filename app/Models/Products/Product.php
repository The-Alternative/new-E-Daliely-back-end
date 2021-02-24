<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
    ['title','slug','brand_id','barcode','productcol','meta','is_active','is_appear','description'];

    public function customfields()
    {
        return $this->belongsToMany(Custom_Field::class)
        ->withTimestamps()
        ->withPivot(['value','description']);
    }
    public function categories(){
        return $this->belongsToMany(category::class)
        ->withTimestamps()
        ->withPivot(['description']);
    }

    public function stores(){
        return $this->belongsToMany(store::class)
        ->withTimestamps()
        ->withPivot(['is_active','is_approve','price','qty']);
    }

    public function product_images(){
        return $this->hasMany(product_image::class);
    }
    public function brand(){
        return $this->belongsTo(brand::class);
    }

    public function product_store_ratings(){
        return $this->hasMany(Product_Store_Rating::class);
    }

    public function order_details(){
        return $this->hasMany(Order_Details::class);
    }
}
