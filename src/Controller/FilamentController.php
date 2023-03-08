<?php
declare(strict_types=1);
namespace App\Controller;

use App\Entity\Filament;
use App\Form\FilamentType;
use App\Repository\FilamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/filament')]
class FilamentController extends AbstractController
{
    #[Route('/', name: 'app_filament_index', methods: ['GET'])]
    public function index(FilamentRepository $filamentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        return $this->render('filament/index.html.twig', [
            'filaments' => $filamentRepository->findBy(['user' => $this->getUser()])
        ]);
    }

    #[Route('/new', name: 'app_filament_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FilamentRepository $filamentRepository, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $filament = new Filament();
        $form = $this->createForm(FilamentType::class, $filament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('file')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('app.files_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $filament->setFilename($newFilename);
            }
            $filament->setUser($this->getUser());
            $filamentRepository->save($filament, true);

            return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('filament/new.html.twig', [
            'filament' => $filament,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filament_show', methods: ['GET'])]
    public function show(Filament $filament): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        if ($this->getUser()->getId() === $filament->getUser()->getId()) {
            return $this->render('filament/show.html.twig', ['filament' => $filament,]);
        }
        $this->addFlash('notice', 'filament.flash.permission');
        return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_filament_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filament $filament, FilamentRepository $filamentRepository, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        if ($this->getUser()->getId() !== $filament->getUser()->getId()) {
            $this->addFlash('notice', 'filament.flash.permission');
            return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(FilamentType::class, $filament);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('file')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('app.files_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $filament->setFilename($newFilename);
            }
            $filamentRepository->save($filament, true);

            return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('filament/edit.html.twig', [
            'filament' => $filament,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filament_delete', methods: ['POST'])]
    public function delete(Request $request, Filament $filament, FilamentRepository $filamentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        if ($this->getUser()->getId() !== $filament->getUser()->getId()) {
            $this->addFlash('notice', 'filament.flash.permission');
            return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
        }
        if ($this->isCsrfTokenValid('delete' . $filament->getId(), $request->request->get('_token'))) {
            $filamentRepository->remove($filament, true);
        }

        return $this->redirectToRoute('app_filament_index', [], Response::HTTP_SEE_OTHER);
    }
}

