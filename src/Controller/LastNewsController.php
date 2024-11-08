<?php

namespace App\Controller;

use App\Entity\LastNews;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LastNewsController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if (isset($_COOKIE["score"])) {
            $score = $_COOKIE["score"];
            // dd($_COOKIE, $score);
        } else {
            $score = 0;
        }
        // Récupérer les 3 dernières actualités triées par date (ordre décroissant)
        $lastNewsRepository = $entityManager->getRepository(LastNews::class);
        $lastNews = $lastNewsRepository->findBy([], ['createdAt' => 'DESC'], 3); // 3 dernières actualités
        
        return $this->render('index/index.html.twig', [
            'lastNews' => $lastNews, // Passer les actualités à la vue
            'score' => $score, // Passer le score à la vue
        ]);
    }
}
