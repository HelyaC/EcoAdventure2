<?php

namespace App\Controller\Admin;

use App\Entity\UserBadge;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class UserBadgeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserBadge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            
            // Association correcte avec `user`
            AssociationField::new('userId')
                ->setLabel('Utilisateur')
                ->setCrudController(UserCrudController::class)
                ->setFormTypeOption('choice_label', 'firstName'), 
            
            TextEditorField::new('challengeDescription')
                ->setLabel('Description du Défi')
                ->hideOnIndex(),
                
            IntegerField::new('points')
                ->setLabel('Points'),
            
            DateTimeField::new('earnedAt')
                ->setLabel('Date d\'obtention')
                ->hideOnForm(),
            
            AssociationField::new('badges')
                ->setLabel('Badges')
                ->setFormTypeOption('choice_label', 'name') // Assurez-vous que `name` existe dans Badge
        ];
    }
}
