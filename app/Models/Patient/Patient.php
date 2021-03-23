<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table='Patients';
    protected $fillable=['id','medical_file_number','first_name','father_name','last_name','nationality',
        'place_of_birth','date_of_birth','address','phone_number','social_status','gender','blood_type',
        'note','is_active','is_approved'];



    //scope
    public function scopeIsActive($query)
    {
        return $query->where('is_active',1)->get();

    }

}
