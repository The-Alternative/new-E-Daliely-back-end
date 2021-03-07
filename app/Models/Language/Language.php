<?php

namespace App\Models\Language;

use App\Models\Brands\Brands;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table='languages';
    protected $fillable=
        [
            'name','abbr','native','is_active','iso_code','locale','flag','rtl'
        ];
    protected $hidden = 
        [
            'created_at', 'updated_at'
        ];
    protected $casts = 
        [
            'is_active' => 'boolean'
        ];


    public function scopeSelectActiveValue($query)
    {
        return $query->where('is_active',1);
    }

    public function scopeSelection($query)
    {
        return $query->select('name','abbr','native','is_active','iso_code','locale','flag','rtl')->get();
    }


    public function getIsActiveAttribute($value)
    {
       return $value==1 ? 'Active' : 'Not Active';
    }


    public function product()
    {
        return $this->belongsToMany(product::class);
    }
    public function brand()
    {
        return $this->belongsToMany(brands::class);
    }
}
