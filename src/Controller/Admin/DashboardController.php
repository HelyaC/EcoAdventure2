<?php 

// src/Controller/Admin/DashboardController.php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\UserBadge;
use App\Entity\UserChallenge;
use App\Entity\Role;
use App\Entity\Recommendation;
use App\Entity\Notification;
use App\Entity\NewsletterSubscription;
use App\Entity\Cours;
use App\Entity\Contact;
use App\Entity\Challenge;
use App\Entity\CarbonFootPrint;
use App\Entity\Badge;



use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem; 

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('Admin/dashboard.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        // Lien vers le dashboard principal
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        // Lien vers l'entité User CRUD
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('User Badges', 'fa fa-award', UserBadge::class);
        yield MenuItem::linkToCrud('User Challenges', 'fas fa-medal', UserChallenge::class);
        yield MenuItem::linkToCrud('Roles', 'fas fa-user-tag', Role::class);
        yield MenuItem::linkToCrud('Recommendations', 'fas fa-comments', Recommendation::class);
        yield MenuItem::linkToCrud('Notifications', 'fas fa-bell', Notification::class);
        yield MenuItem::linkToCrud('Newsletter Subscriptions', 'fas fa-envelope', NewsletterSubscription::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Cours::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Challenges', 'fa fa-trophy', Challenge::class);
        yield MenuItem::linkToCrud('Empreinte Carbone', 'fa fa-leaf', CarbonFootPrint::class); 
        yield MenuItem::linkToCrud('Badges', 'fas fa-trophy', Badge::class);




    }
}
