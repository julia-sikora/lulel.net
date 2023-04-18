<?php
declare(strict_types=1);

namespace App\Controller;

use App\Trait\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filament/profile', priority: 1)]
class ProfileController extends AbstractController
{
    use ControllerTrait;

    #[Route('/', name: 'app_filament_profile')]
    public function new(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        return $this->render('filament/profile.html.twig', ['user' => $this->getUser()]);
    }
}