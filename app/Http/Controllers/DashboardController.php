<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function view()
    {
        $scans = Auth::user()->scans()->with('resume')->latest()->get();
        $topScan = $scans->sortByDesc('score')->first();

        return view('dashboard', [
            'resumes' => Auth::user()->resumes,
            'scans' => $scans,
            'highestScore' => $topScan->score ?? 0
        ]);
    }
}
