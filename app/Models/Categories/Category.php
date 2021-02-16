<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //protected $table = 'categories';'
    public $timestamps = true;
    protected $fillable = ['name','slug','parent_id','image','is_active'];

    public function products(){
        return $this->belongsToMany(product::class)->withTimestamps()->withPivot(['description']);
    }

    public function stores(){
        return $this->belongsToMany(Store::class)->withTimestamps();
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function store_category_images(){
        return $this->hasMany(Store_Category_Image::class);
    }
}
