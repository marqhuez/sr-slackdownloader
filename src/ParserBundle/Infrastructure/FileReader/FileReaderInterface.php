<?php

namespace App\ParserBundle\Infrastructure\FileReader;

use App\ParserBundle\Domain\MemeImageCollection;
use App\ParserBundle\Infrastructure\FileUploader\UploadedExportFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileReaderInterface
{
    public function getUrls(UploadedFile $file) : MemeImageCollection;
}
