<?php

namespace App\Controller;

use App\Entity\Mentor;
use App\Form\MentorType;
use App\Repository\MentorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mentor/control')]
final class MentorControlController extends AbstractController
{
    #[Route(name: 'app_mentor_control_index', methods: ['GET'])]
    public function index(MentorRepository $mentorRepository): Response
    {
        return $this->render('mentor_control/index.html.twig', [
            'mentors' => $mentorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mentor_control_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mentor = new Mentor();
        $form = $this->createForm(MentorType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mentor);
            $entityManager->flush();

            return $this->redirectToRoute('app_mentor_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mentor_control/new.html.twig', [
            'mentor' => $mentor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mentor_control_show', methods: ['GET'])]
    public function show(Mentor $mentor): Response
    {
        return $this->render('mentor_control/show.html.twig', [
            'mentor' => $mentor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mentor_control_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mentor $mentor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MentorType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mentor_control_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mentor_control/edit.html.twig', [
            'mentor' => $mentor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mentor_control_delete', methods: ['POST'])]
    public function delete(Request $request, Mentor $mentor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mentor->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mentor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mentor_control_index', [], Response::HTTP_SEE_OTHER);
    }
}
