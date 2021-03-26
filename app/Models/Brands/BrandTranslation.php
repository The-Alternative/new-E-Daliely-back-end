<?php

namespace App\Models\Brands;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{
    use HasFactory;

    protected $table='brand_translation';
    protected $fillable=['id','brand_id','name','description','locale'];

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }
}
