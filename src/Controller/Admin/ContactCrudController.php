<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID lors de la création ou de la mise à jour
           AssociationField::new('userId')
    ->setLabel('User') // Cela devrait maintenant afficher correctement les utilisateurs
    ->setFormTypeOption('choice_label', 'firstName'),
        TextField::new('name')->setLabel('Name'),
        TextField::new('email')->setLabel('email'), // Champ pour le sujet
        // Champ pour le sujet

            TextField::new('subject')->setLabel('Subject'), // Champ pour le sujet
            TextEditorField::new('message')->setLabel('Message'), // Champ pour le message
            DateTimeField::new('submitedAt')->setLabel('Submitted At'), // Date de soumission masquée lors de la création
        ];
    }
}
