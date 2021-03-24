<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table='Appointments';
    protected $fillable=['id','doctors_id','patients_id','date_time_appointment','is_active','is_approved'];


    //Scope
    public function ScopeIsActive($query)
    {
        return $query->where('is_active',1);
    }
}
