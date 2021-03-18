<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table='social_media';
    protected $fillable=['id','phone_number','whatsapp_number','facebook_account','telegram_account','email','doctor_id','instagram_account','is_active'];
    protected $hidden=['id','created_at','updated_at','doctor_id'];
    public $timestamps =true;

    public function doctor(){

        return $this->belongsTo(doctor::class);
    }
}
