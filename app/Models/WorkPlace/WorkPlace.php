<?php

namespace App\Models\WorkPlace;

use App\Models\Doctors\doctor;
use App\Models\Hospital\Hospital;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlace extends Model
{
    use HasFactory;
    protected $table='work_places';
    protected $fillable=['id','clinic','hospital_id','work_hours','work_day','doctor_id','location_id','is_active'];
    protected $hidden=['id','created_at','updated_at','doctor_id','location_id','pivot'];

    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
