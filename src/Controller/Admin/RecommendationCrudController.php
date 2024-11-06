<?php

namespace App\Controller\Admin;

use App\Entity\Recommendation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class RecommendationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recommendation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID lors de la création/modification
            
            // Association avec l'entité User
            AssociationField::new('userId')
                ->setLabel('User')
                ->setFormTypeOption('choice_label', 'firstName'), // Ou 'email' selon ce qui est approprié
            
            // Champ pour le contenu de la recommandation
            TextEditorField::new('content')
                ->setLabel('Content'),
            
            // Champ pour la date de création
            DateTimeField::new('createdAt')
                ->setLabel('Created At')
                ->hideOnForm() // Masquer sur le formulaire de création/modification
                ->setFormat('yyyy-MM-dd HH:mm:ss'), // Format de la date
        ];
    }
}
