<?php

namespace App\Controller\Admin;

use App\Entity\Notification;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class NotificationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notification::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID lors de la création/modification
            
            // Association avec l'entité User
            AssociationField::new('userId')
                ->setLabel('User')
                ->setFormTypeOption('choice_label', 'firstName'), // Ou 'email' selon ce qui est approprié
            
            // Champ pour le contenu de la notification
            TextEditorField::new('content')
                ->setLabel('Content'),
            
            // Champ pour la date d'envoi
            DateTimeField::new('sentAt')
                ->setLabel('Sent At')
                ->setFormat('yyyy-MM-dd HH:mm:ss'), // Format de la date
            
            // Champ pour le statut de lecture
            BooleanField::new('read')
                ->setLabel('isRead'),
        ];
    }
}
