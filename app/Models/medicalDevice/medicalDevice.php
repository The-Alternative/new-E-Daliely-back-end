<?php

namespace App\Models\medicalDevice;

use App\Models\Doctors\DoctorTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class medicalDevice extends Model
{
    use HasFactory;

    protected $table='medical_devices';
    protected $fillable=['id','name','hospital_id','doctor_id','is_active','is_approved'];
    protected $hidden=['id','pivot','created_at','updated_at','hospital_id','doctor_id'];


    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();

    }

    public function ScopeWithTrans($query)
    {
        return $query=medicalDevice::join('medical_device_translation','medical_device_translation.medical_device_id','=','medical_device_id')
            ->where('medical_device_translation.local','=',get_current_local())
            ->select('medical_device.*','medical_device_translation.*')->get();
    }

    public function medicaldeviceTranslation()
    {
        return $this->hasMany(medicaldeviceTranslation::class,'medical_device_id');
    }
    public function medicaldevice()
    {
        return $this->belongsToMany(medicalDevice::class);
    }
}
