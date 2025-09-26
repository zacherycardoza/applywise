<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use Smalot\PdfParser\Parser as PdfParser;

class ResumeParserService
{
    public function extract(string $filePath): string
    {
        $fullPath = storage_path("app/public/{$filePath}");
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') return $this->parsePdf($fullPath);

        if (in_array($extension, ['doc', 'docx'])) return $this->parseWord($fullPath);

        return Storage::get($filePath);
    }

    protected function parsePdf(string $path): string
    {
        return new PdfParser()->parseFile($path)->getText();
    }

    protected function parseWord(string $path): string
    {
        $phpWord = WordIOFactory::load($path);
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) $text .= $element->getText() . " ";
            }
        }

        return trim($text);
    }
}
