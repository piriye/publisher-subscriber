<?php

namespace App\Interfaces;

interface FileImportInterface
{
    public function processFile($filepath, $processedFile);
}
