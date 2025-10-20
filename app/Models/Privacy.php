<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    protected $fillable = [
        'introduction',
        'information',
        'cookies',
        'google_analytics',
        'third_party_links',
    ];
}
