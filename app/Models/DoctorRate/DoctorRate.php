<?php

namespace App\Models\DoctorRate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;
class DoctorRate extends Model
{
    use HasFactory;
    protected $table='doctor_rates';
    protected $fillable=['id','rate','doctor_id'];

    public function doctor()
    {
        return $this->belongsTo(doctor::class);
    }
}
