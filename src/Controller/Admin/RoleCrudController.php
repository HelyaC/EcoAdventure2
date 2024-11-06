<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            
            // Champ pour la propriété "role"
            TextField::new('role')->setLabel('Role Name'),
            
            // Association avec l'entité User
            AssociationField::new('userId')
                ->setLabel('Users')
                ->setFormTypeOption('choice_label', 'firstName'), // Utilisez le champ de User que vous souhaitez afficher, ici 'username'
        ];
    }
}
