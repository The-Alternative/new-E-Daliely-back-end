<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug','locale','language_id','category_id'];
    public $timestamps = true;

    /////////////////Begin relation here/////////////////////
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
//    public function language()
//    {
//        return $this->belongsTo(Language::class,'');
//    }



}
