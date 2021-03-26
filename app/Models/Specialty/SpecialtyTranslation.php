<?php

namespace App\Models\Specialty;

use App\Models\Specialty\Specialty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyTranslation extends Model
{
    use HasFactory;

    protected $table='specialty_translation';
    protected $fillable=['id','specialty_id','name','locale'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
