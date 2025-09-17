<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamber extends Model
{
    protected $fillable = [
        'location_id',
        'doctor_id',
        'hospital_id',
        'address',
        'visiting_hour',
        'phone',
    ];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'chamber_hospital')
            ->withPivot('address')
            ->withTimestamps();
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
