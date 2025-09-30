<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Scan;

use App\Services\OpenAiResumeAnalyzer;
use App\Services\ResumeParserService;
use App\Services\PromptBuilder;

class ScanController extends Controller
{
    public function index()
    {
        $scans = auth()->user()->scans()->latest()->get();
        return view('scans.index', compact('scans'));
    }

    public function show(Scan $scan)
    {
        return view('scans.show', ['scan' => $scan]);
    }

    public function scan(Request $request, ResumeParserService $parser, PromptBuilder $builder, OpenAiResumeAnalyzer $analyzer)
    {
        //Validate Request
        $request->validate([
            'selected_resume' => ['required', 'integer', 'exists:resumes,id'],
            'job_description' => ['required', 'string'],
        ]);

        $jobDescription = str_replace(["\r\n", "\r"], "\n", $request->job_description);

        //Get Selected Resume
        $resume = Auth::user()->resumes()->findOrFail($request->selected_resume);
        $resumeText = $parser->extract($resume->path);

        // Create Prompt
        $prompt = $builder::build($resumeText, $jobDescription);

        //Call OpenAI API
        $analysis = $analyzer->analyze($prompt);

        //Create Scan Model
        Scan::fromAnalysis($analysis, $resume, $jobDescription)->save();

        //Redirect to Dashboard
        return redirect()->back()->with('success', 'Scan completed successfully.');
    }
}
