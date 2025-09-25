<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;

class DashboardController extends Controller
{
    function view()
    {
        $resumes = Resume::where('user_id', auth()->id())->get();

        return view('dashboard', compact('resumes'));
    }
}
