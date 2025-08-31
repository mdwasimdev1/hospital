<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hospital extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'contact', 'image'];

    // Relationship with Location
    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('address')->withTimestamps();
    }
}
