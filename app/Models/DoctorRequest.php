<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'personal_phone', 'bmdc_number','degrees',
        'fellowships', 'specialty', 'workplace', 'designation',
        'chamber_name', 'chamber_address', 'visiting_hour',
        'appointment_number', 'bKash_transaction', 'about', 'photo', // ✅ Must include 'photo'
    ];

}
