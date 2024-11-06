<?php

namespace App\Controller;

use App\Entity\NewsletterSubscription;
use App\Entity\User;
use App\Repository\NewsletterSubscriptionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use \Mailjet\Client;
use \Mailjet\Resources;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'mail')]
    public function index(): Response
    {
        // $result = $this->sendEmail();
        $result = '';
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
            'result' => $result,
        ]);
    }

    #[Route('/send-NewsLetter', name: 'send.NewsLetter')]
    public function sendEmail(EntityManagerInterface $em): Response
    {
        $subscribers = $em->getRepository(NewsletterSubscription::class)->findAll();
        $userRepository = $em->getRepository(User::class);
        $apiKey = $_ENV['MAILJET_API_KEY'];
        $apiSecret = $_ENV['MAILJET_API_SECRET'];
        $mailjet = new Client($apiKey, $apiSecret, true, ['version' => 'v3.1']);
        $html = $this->renderView('mail/news.html.twig', [
            'imglink' => 'https://thumbs.dreamstime.com/b/jour-de-terre-d-environnement-dans-les-mains-des-arbres-cultivant-jeunes-plantes-bokeh-verdissent-la-main-femelle-fond-tenant-l-130247647.jpg',
            'message' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est laborum enim non distinctio eaque debitis, aut reiciendis incidunt architecto deleniti, sunt vero veritatis unde error corrupti aspernatur facere quisquam repellendus!"
        ]);
        foreach ($subscribers as $subscriber)
        {
            $user = $userRepository->findOneById($subscriber->getUserid());
            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => "quentinmontreuil06@gmail.com",
                            'Name' => "EcoAdventure"
                        ],
                        'To' => [
                            [
                                'Email' => $subscriber->getEmail(),
                                'Name' => $user->getlastName()." ".$user->getfirstName()
                            ]
                        ],
                        'Subject' => "NewsLetter",
                        'HTMLPart' => "$html",
                    ]
                ]
            ];

            $mailjet->post(Resources::$Email, ['body' => $body]);
        }
        return $this->redirect('mail');
    }
}
