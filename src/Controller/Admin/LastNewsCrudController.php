<?php 


// src/Controller/Admin/LastNewsCrudController.php

namespace App\Controller\Admin;

use App\Entity\LastNews;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextAreaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Fields;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
class LastNewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LastNews::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Dernières nouvelles')
            ->setEntityLabelInSingular('Dernière nouvelle')
            ->setEntityLabelInPlural('Dernières nouvelles');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextAreaField::new('content', 'Contenu'),
            TextEditorField::new('content')->setLabel('Content'), // Champ pour le contenu
            ImageField::new('imgUrl')
            ->setBasePath('/uploads/images')  // Chemin relatif aux images si nécessaire
            ->setUploadDir('public/uploads/images')  // Dossier dans lequel les images seront stockées
            ->setUploadedFileNamePattern('[randomhash].[extension]') // Nom du fichier généré (si uploadé)
            ->onlyOnForms()  // Afficher l'URL comme un champ texte sur les pages de formulaire
            ->setFormTypeOption('required', false),
            DateTimeField::new('createdAt', 'Date de création')->setFormat('yyyy-MM-dd HH:mm:ss'),
        ];
    }
}
