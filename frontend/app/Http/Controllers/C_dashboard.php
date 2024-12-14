<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_dashboard extends Controller
{
    public function index()
    {
        return view('dashboard.V_index_dashboard');
    }
}
