<?php 

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    #[Route('/admin/users', name: 'users')]


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Password')->onlyOnForms(),
            IntegerField::new('ecoScore', 'Eco Score')->hideOnIndex(),
            IntegerField::new('placement', 'Placement')->hideOnIndex(),
            BooleanField::new('newsletterSubscription', 'Abonné à la newsletter'),
            DateTimeField::new('createdAt', 'Créer le')->hideOnForm(),
        ];
    }
}
