<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function view()
    {
        return view('auth.register');
    }
}
