<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Contact;
use App\Entity\User;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/send-contact', name: 'send.contact', methods: ['GET','POST'])]
    public function sendContact(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')){
            $contacts = $em->getRepository(Contact::class);
            $users = $em->getRepository(User::class);
            $user = $users->findOneBy(['email' => $request->request->get('email')]);
            $contact = new Contact();
            $contact->setSubject($request->request->get('subject'))
                    ->setMessage($request->request->get('message'))
                    ->setName($request->request->get('name'))
                    ->setEmail($request->request->get('email'))
                    ->setSubmitedAt(new \DateTimeImmutable())
                    ->setUserId($user);
            $em->persist($contact);
            $em->flush();

        }
        
        return $this->redirectToRoute('app_index');
    }
}
