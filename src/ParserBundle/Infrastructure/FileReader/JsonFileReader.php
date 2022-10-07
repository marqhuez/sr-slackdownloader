<?php

namespace App\ParserBundle\Infrastructure\FileReader;

use App\ParserBundle\Domain\MemeImageCollection;
use App\ParserBundle\Infrastructure\FileUploader\UploadedExportFile;
use App\ParserBundle\Infrastructure\Shared\Filesystem\FilesystemManager;

class JsonFileReader implements FileReaderInterface
{
    protected FilesystemManager $filesystem;

    public function __construct(FilesystemManager $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getUrls(UploadedExportFile $file) : MemeImageCollection
    {
        $json = $this->filesystem->getContents($file);
        $posts = json_decode($json, true);

        return MemeImageCollection::createFromArray($posts);
    }
}
