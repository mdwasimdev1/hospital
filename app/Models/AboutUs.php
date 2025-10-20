<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'image',
        'home_description',
        'description',
        'why_create_website',
        'comment',
    ];
}
