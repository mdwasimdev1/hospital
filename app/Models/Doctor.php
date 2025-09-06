<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization_id',
        'hospital_id',
        'designation',
        'location_id',
        'chamber_name',
        'chamber_address',
        'photo',
    ];



    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
