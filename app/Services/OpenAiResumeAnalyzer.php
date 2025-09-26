<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAiResumeAnalyzer
{
    public function analyze(string $prompt): array
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a resume-job matching engine. Always reply in valid JSON.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $content = $response->choices[0]->message->content ?? '{}';
        $analysis = json_decode($content, true);

        return json_last_error() === JSON_ERROR_NONE ? $analysis : [];
    }
}
