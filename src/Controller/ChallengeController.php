<?php 

// src/Controller/ChallengeController.php
namespace App\Controller;

use App\Repository\ChallengeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(ChallengeRepository $challengeRepository): Response
    {
        // Récupérer tous les challenges
        $challenges = $challengeRepository->findAll();
        // Envoyer les données au template
        return $this->render('jeux/jeux.html.twig', [
            'challenges' => $challenges,
        ]);
    }
}
