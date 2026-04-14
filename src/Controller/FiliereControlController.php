<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/filiere/control')]
final class FiliereControlController extends AbstractController
{
    #[Route(name: 'app_filiere_control_index', methods: ['GET'])]
    public function index(FiliereRepository $filiereRepository): Response
    {
        return $this->render('filiere_control/index.html.twig', [
            'filieres' => $filiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_filiere_control_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filiere);
            $entityManager->flush();

            return $this->redirectToRoute('app_filiere_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('filiere_control/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filiere_control_show', methods: ['GET'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('filiere_control/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_filiere_control_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_filiere_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('filiere_control/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filiere_control_delete', methods: ['POST'])]
    public function delete(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_filiere_control_index', [], Response::HTTP_SEE_OTHER);
    }
}
