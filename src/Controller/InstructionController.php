<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstructionController extends AbstractController
{
    #[Route('/instruction', name: 'app_instruction')]
    public function index(CoursRepository $coursRepository): Response
    {
        // Récupère tous les cours de la base de données
        $cours = $coursRepository->findAll();

        // Passe les cours à la vue
        return $this->render('instruction/index.html.twig', [
            'cours' => $cours,
        ]);
    }
}
