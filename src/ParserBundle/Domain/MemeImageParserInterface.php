<?php

namespace App\ParserBundle\Domain;

use App\ParserBundle\Domain\Exception\DomainException;
use App\ParserBundle\Domain\ValueObject\InputFile;

interface MemeImageParserInterface
{
    /**
     * @throws DomainException
     */
    public function getMemeImagesFromFile(InputFile $file): MemeImageCollection;

    /**
     * @throws DomainException
     */
    public function getMemeImagesFromJson(string $json): MemeImageCollection;
}