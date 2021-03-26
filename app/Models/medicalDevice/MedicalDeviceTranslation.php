<?php

namespace App\Models\medicalDevice;

use App\Models\medicalDevice\medicalDevice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDeviceTranslation extends Model
{
    use HasFactory;

    protected $table='medical_device_translation';
    protected $fillable=['id','medical_device_id','name','locale'];

    public function medicaldevice()
    {
        return $this->belongsTo(medicalDevice::class);
    }
}
