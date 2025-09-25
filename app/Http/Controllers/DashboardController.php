<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function view()
    {
        return view('dashboard');
    }
}
