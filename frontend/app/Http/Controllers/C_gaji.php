<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_gaji extends Controller
{
    public function index()
    {

        return view('gaji.V_index_gaji');
    }
}
