<?php

namespace App\Controller\Admin;

use App\Entity\UserChallenge;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserChallengeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserChallenge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('userId')
                ->setLabel('User')
                ->setFormTypeOption('choice_label', 'firstName'), // Ou 'email' selon votre préférence
            AssociationField::new('challengeId')
                ->setLabel('Challenge')
                ->setFormTypeOption('choice_label', 'title'), // Utilisez le champ approprié pour Challenge
            TextField::new('status')->setLabel('Status'),
            DateTimeField::new('completedAt')->setLabel('Completed At')
        ];
    }
}
