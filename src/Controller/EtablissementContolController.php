<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etablissement/contol')]
final class EtablissementContolController extends AbstractController
{
    #[Route(name: 'app_etablissement_contol_index', methods: ['GET'])]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        return $this->render('etablissement_contol/index.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etablissement_contol_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etablissement);
            $entityManager->flush();

            return $this->redirectToRoute('app_etablissement_contol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etablissement_contol/new.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etablissement_contol_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('etablissement_contol/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etablissement_contol_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etablissement_contol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etablissement_contol/edit.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etablissement_contol_delete', methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etablissement_contol_index', [], Response::HTTP_SEE_OTHER);
    }
}
