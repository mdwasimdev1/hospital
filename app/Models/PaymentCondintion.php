<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCondintion extends Model
{
    protected $fillable = [
        'introduction',
        'payment_process',
        'number',
        'apply_process',
    ];
}
