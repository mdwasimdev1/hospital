<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'hospital_id',
        'location_id',
        'specialization_id',
        'designation',
        'photo',
        'about',
        'meta_title',
        'meta_description',
        'preview_images',
        'video_links',
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

    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }
}
