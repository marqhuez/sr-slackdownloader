<?php

namespace App\ParserBundle\Presentation\Web\Controller;

use App\ParserBundle\Application\Exception\ApplicationException;
use App\ParserBundle\Application\GetImagesFromFile\GetImagesFromFileQuery;
use App\ParserBundle\Application\GetShoprenterWorkerById\GetShoprenterWorkerByIdQuery;
use App\ParserBundle\Domain\ShoprenterWorker;
use App\ParserBundle\Infrastructure\FileReader\JsonFileReader;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

class FileUploadController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function index(Session $session): Response
    {
        /** @var ShoprenterWorker $worker */
        $worker = $this->handle(new GetShoprenterWorkerByIdQuery($this->getUser()->getId()));

        $errors = $session->getFlashBag()->get('error', []);

        return $this->render('file_upload/index.html.twig',[
            'fullName' => $worker->getFullName(),
            'errors' => $errors
        ]);
    }

    public function upload(Request $request): Response
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('fileToUpload');

        /** @var ShoprenterWorker $worker */
        $worker = $this->handle(new GetShoprenterWorkerByIdQuery($this->getUser()->getId()));

        try {

            $urls = $this->handle(new GetImagesFromFileQuery(
                $file->getPathname(),
                $file->getClientOriginalName(),
                $worker->getId()
            ));
        } catch (HandlerFailedException $exception) {
            $this->addFlash('error', $exception->getPrevious()->getMessage());
            return $this->redirectToRoute('file_upload');
        }


        return $this->render('file_upload/list.html.twig',[
            'urls' => $urls
        ]);
    }
}
