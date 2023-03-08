<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Model\Form\RegisterModel;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute("app_homepage");
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $registerModel = new RegisterModel();
        $form = $this->createForm(RegisterType::class, $registerModel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $appPassword = $this->getParameter('app.register_password');
            if ($registerModel->getAppPassword() === $appPassword) {
                $user = new User();
                $hashedPassword = $passwordHasher->hashPassword($user, $registerModel->getPassword());
                $user
                    ->setEmail($registerModel->getEmail())
                    ->setNickname($registerModel->getNickname())
                    ->setPassword($hashedPassword);

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('notice', 'register.flash.account_added');
                return $this->redirectToRoute('app_login');
            }
            $this->addFlash('notice', 'register.flash.app_password');

            return $this->redirectToRoute('app_register');
        }

        return $this->render('register.html.twig', ['form' => $form]);
    }
}
