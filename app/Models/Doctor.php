<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'hospital_id',
        'hospital_name',
        'location_id',
        'specialization_id',
        'speciality',
        'designation',
        'degree',
        'photo',
        'about',
        'meta_title',
        'meta_description',
        'preview_images',
        'video_links',
        'position',
    ];

   





    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function hospital()
    {
        return $this->belongsTo(hospital::class);
    }

    public function location()
    {
        return $this->belongsTo(location::class);
    }

    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }
}
