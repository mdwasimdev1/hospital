<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{


    protected $fillable = ['name', 'slug', 'location_id', 'title', 'description', 'meta_title', 'meta_description'];

    public function location()
    {
        return $this->belongsTo(location::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specialization_id');
    }
}
