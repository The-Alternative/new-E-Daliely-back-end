<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','meta','short_des','long_des','product_id'
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
