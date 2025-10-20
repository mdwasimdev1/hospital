<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'description',
        'conditions',
        'position_priority',
        'transparency',
        'pricing_policy',
        'display_policy',
        'renewal_policy',
        'rights_and_preparation'
    ];
}
