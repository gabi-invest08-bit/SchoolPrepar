<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rendez/vous/control')]
final class RendezVousControlController extends AbstractController
{
    #[Route(name: 'app_rendez_vous_control_index', methods: ['GET'])]
    public function index(RendezVousRepository $rendezVousRepository): Response
    {
        return $this->render('rendez_vous_control/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rendez_vous_control_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rendezVou = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rendezVou);
            $entityManager->flush();

            return $this->redirectToRoute('app_rendez_vous_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendez_vous_control/new.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rendez_vous_control_show', methods: ['GET'])]
    public function show(RendezVous $rendezVou): Response
    {
        return $this->render('rendez_vous_control/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rendez_vous_control_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendezVous $rendezVou, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rendez_vous_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendez_vous_control/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rendez_vous_control_delete', methods: ['POST'])]
    public function delete(Request $request, RendezVous $rendezVou, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rendez_vous_control_index', [], Response::HTTP_SEE_OTHER);
    }
}
