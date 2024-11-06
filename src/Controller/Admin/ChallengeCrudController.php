<?php 

namespace App\Controller\Admin;

use App\Entity\Challenge;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ChallengeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Challenge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom du Challenge'),
            TextEditorField::new('description')->setLabel('Description'),
            AssociationField::new('userId') // Changez 'created_by' par 'userId'
            ->setLabel('Créé par') // Label pour l'utilisateur créateur
            ->setFormTypeOption('choice_label', 'firstName'),           
            DateTimeField::new('createdAt')->setLabel('Créé le')->hideOnForm(),
            TextField::new('type')->setLabel('Type'),
            AssociationField::new('userChallenges')
                ->setLabel('Challenges Utilisateurs')
                ->setFormTypeOption('choice_label', function ($userChallenge) {
                    return $userChallenge->getUserId()->getFirstName(); // Utilisez getUserId() pour obtenir l'entité User
                }),
            AssociationField::new('userId')
                ->setLabel('Utilisateur Créateur')
                ->setFormTypeOption('choice_label', function ($user) {
                    return $user->getFirstName(); // Utilisez getFirstName() pour afficher le prénom de l'utilisateur
                }),
        ];
    }
}
