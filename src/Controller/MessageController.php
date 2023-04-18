<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Trait\ControllerTrait;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

#[Route('/filament/message', priority: 1)]
class MessageController extends AbstractController
{
    use ControllerTrait;

    #[Route('/', name: 'app_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessageRepository $messageRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setUser($this->getUser());
            $message->setDateOfCreation(new DateTime());
            $messageRepository->save($message, true);
            return $this->render('message/sent.html.twig', ['message' => $message]);
        }
        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }
}
