<?php

namespace App\ParserBundle\Application\GetImagesFromInput;

use App\ParserBundle\Domain\Input\SlackInput;

class GetImagesFromInputQuery
{
    private SlackInput $input;
    private int $workerId;

    public function __construct(
        mixed $input,
        int    $workerId
    )
    {
        $this->input = $input;
        $this->workerId = 1;
    }

    public function getWorkerId(): int
    {
        return $this->workerId;
    }

    public function getInput(): mixed
    {
        return $this->input;
    }
}