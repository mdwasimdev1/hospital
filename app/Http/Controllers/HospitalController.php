<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function addHospital()
    {
        return view('admin.add_hospital');
    }
}
