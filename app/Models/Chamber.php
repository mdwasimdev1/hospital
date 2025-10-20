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
        return $this->belongsToMany(hospital::class, 'chamber_hospital')
            ->withPivot('address','phone', 'visiting_hour')
            ->withTimestamps();
    }


    public function location()
    {
        return $this->belongsTo(location::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
