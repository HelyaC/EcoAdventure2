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
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/send-NewsLetter', name: 'send.NewsLetter', methods: ['GET', 'POST'])]
    public function sendEmail(EntityManagerInterface $em, Request $request): Response
    {
        $subscribers = $em->getRepository(NewsletterSubscription::class)->findAll();
        $userRepository = $em->getRepository(User::class);
        $apiKey = $_ENV['MAILJET_API_KEY'];
        $apiSecret = $_ENV['MAILJET_API_SECRET'];
        $mailjet = new Client($apiKey, $apiSecret, true, ['version' => 'v3.1']);
        $html = $this->renderView('mail/news.html.twig', [
            'imglink' => $request->request->get('imgurl'),
            'message' => $request->request->get('message')
        ]);
        foreach ($subscribers as $subscriber)
        {
            $user = $userRepository->findOneById($subscriber->getUserid());
            if ($user != null)
            {
                $name = $user->getlastName()." ".$user->getfirstName();
            } else
            {
                $name = $subscriber->getEmail();
            }
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
                                'Name' => $name
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

    #[Route('/add-subscriber', name: 'add.subscriber', methods: ['GET', 'POST'])]
    public function addSubscriber(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')){
            $email = $request->request->get('email');
            $subscription = $em->getRepository(NewsletterSubscription::class);
            $userRepository = $em->getRepository(User::class);
            $subscriber = new NewsletterSubscription();
            $subscriber->setEmail($email);
            $subscriber->setSubscribedAt(new \DateTimeImmutable());
            $subscriber->setUserId($userRepository->findOneById(3));
            $em->persist($subscriber);
            $em->flush();
        }
        return $this->redirectToRoute('app_index');
    }
}