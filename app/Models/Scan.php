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
}
