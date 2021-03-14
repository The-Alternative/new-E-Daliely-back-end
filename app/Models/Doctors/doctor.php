<?php

namespace App\Models\Doctors;

use App\Models\SocialMedia\SocialMedia;
use App\Models\WorkPlace\WorkPlace;
use App\Models\Specialty\Specialty;
use App\Models\DoctorRate\DoctorRate;
use App\Models\medicalDevice\medicalDevice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    use HasFactory;
    protected $table='Doctors';
    protected $fillable =['Id','name','image','description','specialty_id','social_media_id','is_active','is_approved'];

    public function socialMedia(){
        return $this->hasMany(SocialMedia::class);
    }
    public  function workPlace()
    {
        return $this->belongsToMany(workPlace::class);
    }

    public  function Specialty()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public  function medicalDevice()
    {
        return $this->belongsToMany(medicalDevice::class);
    }

    public function DoctorRate()
    {
        return $this->hasOne(DoctorRate::class);
    }

}
