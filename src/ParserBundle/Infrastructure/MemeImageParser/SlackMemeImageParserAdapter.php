<?php

namespace App\ParserBundle\Infrastructure\MemeImageParser;

use App\ParserBundle\Domain\Exception\DomainException;
use App\ParserBundle\Domain\Input\SlackInput;
use App\ParserBundle\Domain\MemeImageCollection;
use App\ParserBundle\Domain\MemeImageParserInterface;
use App\ParserBundle\Infrastructure\FileReader\FileReaderInterface;
use App\ParserBundle\Infrastructure\FileUploader\FileUploaderInterface;
use App\ParserBundle\Infrastructure\FileUploader\TempFile;
use Exception;

class SlackMemeImageParserAdapter implements MemeImageParserInterface
{
    private FileUploaderInterface $fileUploader;
    private FileReaderInterface $reader;

    public function __construct(FileUploaderInterface $fileUploader, FileReaderInterface $reader)
    {
        $this->fileUploader = $fileUploader;
        $this->reader = $reader;
    }

    public function getMemeImagesFromInput(SlackInput $input): MemeImageCollection
    {
        if ($input->isFile()) {
            $file = $input->getContent();

            $tempFile = new TempFile(
                $file->getFilePath()
            );

            try {
                $uploadedExportFile = $this->fileUploader->uploadFile($tempFile, $file->getFileName());
                return $this->reader->getUrls($uploadedExportFile);
            } catch (Exception $exception) {
                throw new DomainException($exception->getMessage(),$exception->getCode());
            }
        } else {
            $json = $input->getContent();

            $posts = json_decode($json, true);

            return MemeImageCollection::createFromArray($posts);
        }
    }
}