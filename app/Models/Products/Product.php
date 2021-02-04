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
}
