<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class HelloController extends AbstractController
{
    private const DEFAULT_LANGUAGE = 'en';

    #[Route('/{lang}', name: 'app_homepage_lang')]
    public function homepage(LocaleSwitcher $localeSwitcher, string $lang = self::DEFAULT_LANGUAGE): Response
    {
        $localeSwitcher->setLocale($lang );
        return $this->render('homepage.html.twig');
    }
}
