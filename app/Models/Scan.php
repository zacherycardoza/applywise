<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scan extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'user_id',
        'job_title',
        'job_description',
        'score',
        'skills_match',
        'experience_match',
        'education_match',
        'keywords_matched',
        'keywords_total',
        'missing_skills',
        'matched_skills',
        'recommendations',
    ];

    protected $casts = [
        'missing_skills'   => 'array',
        'matched_skills'   => 'array',
        'recommendations'  => 'array',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function fromAnalysis(array $analysis, Resume $resume, string $jobDescription): self
    {
        return new self([
            'resume_id'        => $resume->id,
            'user_id'          => $resume->user_id,
            'job_title'        => $analysis['job_title'] ?? null,
            'job_description'  => $jobDescription,
            'score'            => $analysis['score'] ?? 0,
            'skills_match'     => $analysis['skills_match'] ?? 0,
            'experience_match' => $analysis['experience_match'] ?? 0,
            'education_match'  => $analysis['education_match'] ?? 0,
            'keywords_matched' => count($analysis['keywords_matched'] ?? []),
            'keywords_total'   => count(($analysis['keywords_matched'] ?? [])) + count(($analysis['missing_skills'] ?? [])),
            'missing_skills'   => $analysis['missing_skills'] ?? [],
            'matched_skills'   => $analysis['keywords_matched'] ?? [],
            'recommendations'  => $analysis['recommendations'] ?? [],
        ]);
    }
}
