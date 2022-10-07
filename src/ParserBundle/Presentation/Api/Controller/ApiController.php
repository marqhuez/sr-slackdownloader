<?php

namespace App\ParserBundle\Presentation\Api\Controller;

use App\ParserBundle\Application\GetImagesFromJson\GetImagesFromJsonQuery;
use App\ParserBundle\Application\GetShoprenterWorkerById\GetShoprenterWorkerByIdQuery;
use App\ParserBundle\Domain\ShoprenterWorker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class ApiController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function parseSlackJson(Request $request): Response
    {

//        /** @var ShoprenterWorker $worker */
//        $worker = $this->handle(new GetShoprenterWorkerByIdQuery($this->getUser()->getId()));

        try {
            $urls = $this->handle(new GetImagesFromJsonQuery($request->getContent()/*, $worker->getId()*/));
        } catch (HandlerFailedException $exception) {
            $this->addFlash('error', $exception->getPrevious()->getMessage());
            return $this->json(500);
        }

        return $this->json($urls, 200);
    }
}