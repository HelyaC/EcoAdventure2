<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cours::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Masquer l'ID lors de la création ou de la modification
            TextField::new('title')->setLabel('Title'), // Champ pour le titre
            TextEditorField::new('content')->setLabel('Content'), // Champ pour le contenu
            TextField::new('imageUrl')->setLabel('Image URL'), // Champ pour l'URL de l'image
            DateTimeField::new('createdAt')->setLabel('Created At')->hideOnForm(), // Date de création masquée lors de l'ajout d'un cours
        ];
    }
}
