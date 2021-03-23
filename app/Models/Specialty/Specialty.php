<?php

namespace App\Models\Specialty;

use App\Models\Doctors\doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $table='specialties';
    protected $fillable=['id','name','graduation_year','is_active'];


    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();

    }
    public function doctor()
    {
        return $this->belongsToMany(doctor::class);
    }
}
