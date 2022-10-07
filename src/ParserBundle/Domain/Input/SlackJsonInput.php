<?php

namespace App\ParserBundle\Domain\Input;

class SlackJsonInput implements SlackInput
{
    private bool $isFile = false;
    private string $json;

    public function __construct(string $json)
    {
        $this->json = $json;
    }

    public function isFile(): bool
    {
        return $this->isFile;
    }

    public function getContent(): mixed
    {
        return $this->json;
    }
}