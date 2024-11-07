<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

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
            ImageField::new('imageUrl')
            ->setBasePath('/uploads/images')  // Chemin relatif aux images si nécessaire
            ->setUploadDir('public/uploads/images')  // Dossier dans lequel les images seront stockées
            ->setUploadedFileNamePattern('[randomhash].[extension]') // Nom du fichier généré (si uploadé)
            ->onlyOnForms()  // Afficher l'URL comme un champ texte sur les pages de formulaire
            ->setFormTypeOption('required', false),            DateTimeField::new('createdAt')->setLabel('Created At')->hideOnForm(), // Date de création masquée lors de l'ajout d'un cours
        ];
    }
}
