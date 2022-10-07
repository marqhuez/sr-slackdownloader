<?php

namespace App\ParserBundle\Domain;

use App\ParserBundle\Domain\Exception\DomainException;
use App\ParserBundle\Domain\Input\SlackInput;

interface MemeImageParserInterface
{
    /**
     * @throws DomainException
     */
    public function getMemeImagesFromInput(SlackInput $input): MemeImageCollection;
}