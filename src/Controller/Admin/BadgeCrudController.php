<?php 

namespace App\Controller\Admin;

use App\Entity\Badge;
use App\Entity\UserBadge;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BadgeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Badge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ ID caché dans les formulaires
            // Champ pour le nom du badge
            TextField::new('name')->setLabel('Nom du Badge'),
            // Champ pour le logo du badge (URL)
            TextField::new('logoUrl')->setLabel('URL du Logo'),
            // Champ pour la description du badge
            TextEditorField::new('description')->setLabel('Description'),
        ];
    }
}
