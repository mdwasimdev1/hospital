<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'contact',
        'image',
        'meta_title',
        'meta_description',
    ];

    // Relationship with Location
    // public function locations()
    // {
    //     return $this->belongsToMany(Location::class)->withPivot('address')->withTimestamps();
    // }
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'hospital_location')
            ->withPivot('address'); // 👈 This is key!
    }


    public function chambers()
    {
        return $this->belongsToMany(Chamber::class, 'chamber_hospital')
            ->withPivot('address')
            ->withTimestamps();
    }
}
