<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use \Mailjet\Client;
use \Mailjet\Resources;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(): Response
    {
        $content = $this->renderView('mail/news.html.twig', [
            'imglink' => 'https://thumbs.dreamstime.com/b/jour-de-terre-d-environnement-dans-les-mains-des-arbres-cultivant-jeunes-plantes-bokeh-verdissent-la-main-femelle-fond-tenant-l-130247647.jpg',
            'message' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est laborum enim non distinctio eaque debitis, aut reiciendis incidunt architecto deleniti, sunt vero veritatis unde error corrupti aspernatur facere quisquam repellendus!"
        ]);
        $result = $this->sendEmail($content);
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
            'result' => $result,
        ]);
    }

    private function sendEmail($html): Response
    {
        $apiKey = $_ENV['MAILJET_API_KEY'];
        $apiSecret = $_ENV['MAILJET_API_SECRET'];
        $mailjet = new Client($apiKey, $apiSecret, true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "quentinmontreuil06@gmail.com",
                        'Name' => "EcoAdventure"
                    ],
                    'To' => [
                        [
                            'Email' => "ghashog74@gmail.com",
                            'Name' => "Destinataire"
                        ]
                    ],
                    'Subject' => "NewsLetter",
                    'HTMLPart' => "$html",
                ]
            ]
        ];

        $response = $mailjet->post(Resources::$Email, ['body' => $body]);

        if ($response->success()) {
            return new Response('Email envoyé avec succès');
        }

        return new Response('Erreur lors de l\'envoi de l\'email', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
