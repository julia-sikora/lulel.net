<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

#[Route('/filament/admin', priority: 1)]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_filament_admin')]
    public function index(MessageRepository $messageRepository): Response
    {
        try {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        } catch (Throwable) {
            $this->addFlash('notice', 'filament.flash.permission');
            return $this->redirectToRoute('app_filament_index');
        }
        return $this->render('filament/admin.html.twig', ['messages' => $messageRepository->findAll()]);
    }
}