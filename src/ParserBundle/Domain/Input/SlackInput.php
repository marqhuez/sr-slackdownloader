<?php

namespace App\ParserBundle\Domain\Input;

interface SlackInput
{
    public function isFile(): bool;

    public function getContent(): mixed;
}