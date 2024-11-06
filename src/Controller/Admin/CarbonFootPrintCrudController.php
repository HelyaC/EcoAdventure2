<?php

namespace App\Controller\Admin;

use App\Entity\CarbonFootPrint;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField; // Utilisation de NumberField
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarbonFootPrintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarbonFootPrint::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ ID caché dans les formulaires
            TextField::new('id')->hideOnForm(),
            // Association avec l'entité User
            AssociationField::new('userId')
            ->setLabel('User') // Cela devrait maintenant afficher correctement les utilisateurs
            ->setFormTypeOption('choice_label', 'firstName'),            // Champ pour l'empreinte carbone
            NumberField::new('footPrintScore')->setLabel('Score d\'Empreinte Carbone'),
            // Champ pour la date de calcul
            DateTimeField::new('calculated')->setLabel('Calculé à'),
        ];
    }
}
