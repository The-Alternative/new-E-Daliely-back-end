<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\SectionTranslation;


class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = [
        'slug', 'image', 'is_active'];
//________________ scopes begin _________________//

    public function scopeWithTrans($query)
    {
        return $query= Section::join('section_translations', 'section_translations.section_id', '=', 'sections.id')
            ->where('section_translations.local','=',get_current_local())
            ->select('sections.*','section_translations.*');
    }

    //________________ scopes end _________________//

    public function SectionTranslation()
    {
        return $this->hasMany(SectionTranslation::class,'section_id');
    }
//    public function Section()
//    {
//        return $this->hasMany(Section::class,'section_id');
//    }

}
