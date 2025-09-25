<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    function scan(Request $request)
    {
        //validate request
        $request->validate([
            'selected_resume' => ['required', 'integer'],
            'job_description' => ['required', 'string']
        ]);

        //run info through openai api

        //gather info from response
        $jobTitle = null;
        $score = null;
        $skillsMatch = null;
        $experienceMatch = null;
        $educationMatch = null;
        $keywordsMatch = null;
        $missingSkills = null;
        $matchedSkills = null;
        $recommendations = null;

        // create the scan record
        Scan::create([
            'resume_id' => $request->selected_resume,
            'user_id' => Auth::user()->id,
            'job_title' => $jobTitle,
            'job_description' => $request->job_description,
            // 'score' => $score,
            // 'skills_match' => $skillsMatch,
            // 'experience_match' => $experienceMatch,
            // 'education_match' => $educationMatch,
            // 'keywords_match' => $keywordsMatch,
            // 'missing_skills' => $missingSkills,
            // 'matched_skills' => $matchedSkills,
            // 'recommendations' => $recommendations,
        ]);

        //redirect back
        return redirect()->back();
    }
}
