<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class ScanController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'selected_resume' => ['required', 'integer', 'exists:resumes,id'],
            'job_description' => ['required', 'string'],
        ]);

        $resume = Auth::user()->resumes()->findOrFail($request->selected_resume);
        $resumeText = "Sample resume text here..."; // TODO: extract real resume text

        $prompt  = "Compare the following RESUME and JOB DESCRIPTION.\n";
        $prompt .= "Provide structured JSON output with the following fields:\n";
        $prompt .= "- job_title (string)\n";
        $prompt .= "- score (0-100)\n";
        $prompt .= "- skills_match (0-100)\n";
        $prompt .= "- experience_match (0-100)\n";
        $prompt .= "- education_match (0-100)\n";
        $prompt .= "- keywords_matched (array of matched keywords)\n";
        $prompt .= "- missing_skills (array of missing skills)\n";
        $prompt .= "- recommendations (array of text suggestions)\n\n";
        $prompt .= "RESUME:\n$resumeText\n\n";
        $prompt .= "JOB DESCRIPTION:\n{$request->job_description}";

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a resume-job matching engine. Always reply in valid JSON.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ],
            ],
        ]);
        $content = $response->choices[0]->message->content ?? '{}';
        $analysis = json_decode($content, true);
        dd($content, $analysis);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $analysis = [];
        }

        Scan::create([
            'resume_id'       => $resume->id,
            'user_id'         => Auth::id(),
            'job_title'       => $analysis['job_title'] ?? null,
            'job_description' => $request->job_description,
            'score'           => $analysis['score'] ?? 0,
            'skills_match'    => $analysis['skills_match'] ?? 0,
            'experience_match' => $analysis['experience_match'] ?? 0,
            'education_match' => $analysis['education_match'] ?? 0,
            'keywords_matched' => isset($analysis['keywords_matched']) ? count($analysis['keywords_matched']) : 0,
            'keywords_total'  => isset($analysis['keywords_matched'], $analysis['missing_skills'])
                ? count($analysis['keywords_matched']) + count($analysis['missing_skills'])
                : 0,
            'missing_skills'  => $analysis['missing_skills'] ?? [],
            'matched_skills'  => $analysis['keywords_matched'] ?? [],
            'recommendations' => $analysis['recommendations'] ?? [],
        ]);

        return redirect()->back()->with('success', 'Scan completed successfully.');
    }
}
