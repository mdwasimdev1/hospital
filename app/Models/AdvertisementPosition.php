<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementPosition extends Model
{
    protected $fillable = ['position', 'duration', 'price'];
}
