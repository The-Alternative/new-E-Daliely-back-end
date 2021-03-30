<?php

namespace App\Models\Specialty;

use App\Models\Doctors\doctor;
use App\Models\medicalDevice\medicalDevice;
use App\Models\medicalDevice\MedicalDeviceTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $table='specialties';
    protected $fillable=['id','name','graduation_year','is_active'];


    //scope
    public function scopeActive($query)
    {
        return $query->where('is_active',1);

    }

    public function ScopeWithTrans($query)
    {
        return $query=Specialty::join('specialty_translation','specialty_translation.specialty_id','=','specialty_id')
            ->where('specialty_translation.locale','=',get_current_local())
            ->select('specialties.*','specialty_translation.*');
    }

    public function specialtyTranslation()
    {
        return $this->hasMany(SpecialtyTranslation::class,'specialty_id');
    }
    public function specialty()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }
}
