<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use Smalot\PdfParser\Parser as PdfParser;

class ResumeParserService
{
    public function extract(string $filePath): string
    {
        $disk = Storage::disk(config('filesystems.default'));

        if (!$disk->exists($filePath)) throw new \Exception("Resume file not found: {$filePath}");

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $tmpFile = tempnam(sys_get_temp_dir(), 'resume_');
        file_put_contents($tmpFile, $disk->get($filePath));

        try {
            if ($extension === 'pdf') return $this->parsePdf($tmpFile);
            if (in_array($extension, ['doc', 'docx'])) return $this->parseWord($tmpFile);

            return $disk->get($filePath);
        } finally {
            @unlink($tmpFile);
        }
    }

    protected function parsePdf(string $path): string
    {
        return (new PdfParser())->parseFile($path)->getText();
    }

    protected function parseWord(string $path): string
    {
        $phpWord = WordIOFactory::load($path);
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . ' ';
                }
            }
        }

        return trim($text);
    }
}
