<?php

namespace App\Models\Brands;

use App\Models\Language\Language;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

//    protected $table='brands';

    protected $fillable=['id','name','slug','description','image','is_active'];


    //scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
    public function language()
    {
        return $this->belongsToMany(language::class);
    }
}
