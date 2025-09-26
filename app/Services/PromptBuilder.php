<?php

namespace App\Services;

class PromptBuilder
{
    public static function build(string $resumeText, string $jobDescription): string
    {
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
        $prompt .= "RESUME:\n{$resumeText}\n\n";
        $prompt .= "JOB DESCRIPTION:\n{$jobDescription}";

        return $prompt;
    }
}
