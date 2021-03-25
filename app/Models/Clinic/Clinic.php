<?php

namespace App\Models\Clinic;

use App\Models\Doctors\doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $table='clinics';
    protected $fillable=['id','doctors_id','name','location_id','phone_number','is_active','is_approved'];

    public function doctor()
    {
        return $this->hasOne(doctor::class);
    }
}
