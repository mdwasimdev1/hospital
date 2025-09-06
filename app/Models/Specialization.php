<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{


    protected $fillable = ['name', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specialization_id');
    }
}
