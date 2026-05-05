<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Filiere;
use App\Entity\Etablissement;
use App\Entity\Mentor;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $filieres = $entityManager->getRepository(Filiere::class)->findBy([], ['nom' => 'ASC'], 12);
        $etablissements = $entityManager->getRepository(Etablissement::class)->findBy([], ['nom' => 'ASC'], 6);
        $mentors = $entityManager->getRepository(Mentor::class)->findBy([], ['profession' => 'ASC'], 5);

        $stats = [
            'filieresCount' => count($filieres),
            'etablissementsCount' => $entityManager->getRepository(Etablissement::class)->count([]),
            'mentorsCount' => $entityManager->getRepository(Mentor::class)->count([]),
        ];

        return $this->render('grad-school-1.0.0/index.html.twig', [
            'filieres' => $filieres,
            'etablissements' => $etablissements,
            'mentors' => $mentors,
            'stats' => $stats,
        ]);
    }
}

