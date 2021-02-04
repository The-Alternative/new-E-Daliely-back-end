<?php

namespace App\Models\Language;

use App\Models\Brands\Brands;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $primaryKey = 'lang_id';

    protected $table='languages';

    protected $fillable=['lang_id','name','active','iso_code','lang_code','locale','date_format_lite','date_format_full','is_rtl'];

    public function brand()
    {
        return $this->belongsToMany(brands::class);
    }
}
