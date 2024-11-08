<?php 


// src/Controller/Admin/DashboardController.php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

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
use App\Entity\LastNews;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;

class DashboardController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // Récupérer les statistiques pour chaque entité
        $totalUsers = $this->entityManager->getRepository(User::class)->count([]);
        $totalBadges = $this->entityManager->getRepository(UserBadge::class)->count([]);
        $totalChallenges = $this->entityManager->getRepository(UserChallenge::class)->count([]);
        $totalRecommendations = $this->entityManager->getRepository(Recommendation::class)->count([]);
        $totalNotifications = $this->entityManager->getRepository(Notification::class)->count([]);
        $totalCourses = $this->entityManager->getRepository(Cours::class)->count([]);
        $totalContacts = $this->entityManager->getRepository(Contact::class)->count([]);
        $totalChallengesCount = $this->entityManager->getRepository(Challenge::class)->count([]);
        $totalCarbonFootprints = $this->entityManager->getRepository(CarbonFootPrint::class)->count([]);
        $totalBadgesCount = $this->entityManager->getRepository(Badge::class)->count([]);
        $totalNews = $this->entityManager->getRepository(LastNews::class)->count([]);

        // Rendre la vue avec les statistiques
        return $this->render('admin/dashboard.html.twig', [
            'totalUsers' => $totalUsers,
            'totalBadges' => $totalBadges,
            'totalChallenges' => $totalChallenges,
            'totalRecommendations' => $totalRecommendations,
            'totalNotifications' => $totalNotifications,
            'totalCourses' => $totalCourses,
            'totalContacts' => $totalContacts,
            'totalChallengesCount' => $totalChallengesCount,
            'totalCarbonFootprints' => $totalCarbonFootprints,
            'totalBadgesCount' => $totalBadgesCount,
            'totalNews' => $totalNews,
        ]);
    }

    public function configureMenuItems(): iterable
    {
// Dans votre contrôleur ou dans le fichier de configuration de EasyAdmin

// Ceci représente un item de menu spécifique pour le Dashboard
yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home')
    ->setCssClass('custom-dashboard');  // Ajouter une info-bulle ou un texte d'aide

        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Roles', 'fas fa-user-tag', Role::class);
        yield MenuItem::linkToCrud('Badges des Utilisateurs', 'fa fa-award', UserBadge::class);
        // yield MenuItem::linkToCrud('Challenges des Utilisateurs', 'fas fa-medal', UserChallenge::class);
        yield MenuItem::linkToCrud('Recommandations', 'fas fa-comments', Recommendation::class);
        yield MenuItem::linkToCrud('Notifications', 'fas fa-bell', Notification::class);
        yield MenuItem::linkToCrud('Abonnements à la Newsletter', 'fas fa-envelope', NewsletterSubscription::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Cours::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Challenges', 'fa fa-trophy', Challenge::class);
        // yield MenuItem::linkToCrud('Empreinte Carbone', 'fa fa-leaf', CarbonFootPrint::class);
        yield MenuItem::linkToCrud('Badges', 'fas fa-trophy', Badge::class);
        yield MenuItem::linkToCrud('Dernières Nouvelles', 'fa fa-newspaper', LastNews::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }

    #[Route('/admin/users', name: 'admin_user_list')]
    public function users(): Response
    {
        return $this->render('admin/user_list.html.twig');
    }
}
