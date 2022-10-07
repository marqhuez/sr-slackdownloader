<?php

namespace App\ParserBundle\Domain\Input;

use App\ParserBundle\Domain\ValueObject\InputFile;

class SlackFileInput implements SlackInput
{
    private bool $isFile = true;
    private InputFile $file;

    public function __construct(string $pathname, string $filename)
    {
        $this->file = new InputFile($pathname, $filename);
    }

    public function isFile(): bool
    {
        return $this->isFile;
    }

    public function getContent(): InputFile
    {
        return $this->file;
    }
}