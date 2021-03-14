<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors\doctor;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table='social_media';
    protected $fillable=['id','phone_number','whatsapp_number','facebook_account','telegram_account','email'];

    public function doctor(){

        return $this->belongsTo(doctor::class);
    }
}
