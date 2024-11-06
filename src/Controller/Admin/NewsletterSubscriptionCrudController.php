<?php

namespace App\Controller\Admin;

use App\Entity\NewsletterSubscription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsletterSubscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewsletterSubscription::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID lors de la création ou de la modification
            
            // Association avec l'entité User
            AssociationField::new('userId')
                ->setLabel('User')
                ->setFormTypeOption('choice_label', 'firstName'), // Assurez-vous que 'username' est un champ valide dans l'entité User
            
            // Champ pour l'adresse e-mail
            TextField::new('email')
                ->setLabel('Email'),
            
            // Champ pour la date d'abonnement
            DateTimeField::new('subscribedAt')
                ->setLabel('Subscribed At')
                ->setFormat('yyyy-MM-dd HH:mm:ss'), // Format de la date
        ];
    }
}
