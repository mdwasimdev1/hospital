<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class)->withPivot('address')->withTimestamps();
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
}
