<?php

namespace App\Models\medicalDevice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class medicalDevice extends Model
{
    use HasFactory;

    protected $table='medical_devices';
    protected $fillable=['id','name','hospital_id','doctor_id','is_active','is_approved'];
    protected $hidden=['id','pivot','created_at','updated_at'];

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }
}
