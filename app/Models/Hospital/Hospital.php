<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkPlace\WorkPlace;

class Hospital extends Model
{
    use HasFactory;
    protected $table='hospitals';
    protected $fillable=['id','name','medical_center','general_hospital','private_hospital','location_id','is_active','is_approved'];


    public function workplace()
    {
        return $this->hasOne(WorkPlace::class);
    }
}
