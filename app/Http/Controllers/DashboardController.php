<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function view()
    {
        $resumes = Resume::where('user_id', auth()->id())->get();
        $scans = Auth::user()->scans()->with('resume')->get();

        return view('dashboard', [
            'resumes' => $resumes,
            'scans' => $scans
        ]);
    }
}
