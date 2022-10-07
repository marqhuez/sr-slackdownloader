<?php

namespace App\ParserBundle\Application\GetImagesFromJson;

class GetImagesFromJsonQuery
{
    private string $json;
//    private int $workerId;

    public function __construct(
        string $json,
//        int    $workerId
    )
    {
        $this->json = $json;
//        $this->workerId = $workerId;
    }

//    public function getWorkerId(): int
//    {
//        return $this->workerId;
//    }

    public function getJson(): string
    {
        return $this->json;
    }
}