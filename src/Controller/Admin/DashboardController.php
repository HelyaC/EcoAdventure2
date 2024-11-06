<?php

// src/Controller/Admin/DashboardController.php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Quiz;
use App\Entity\Question;
use App\Entity\Answer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem; // Import correct pour MenuItem

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        // Lien vers le dashboard principal
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // Lien vers l'entité User CRUD
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);

    }
}