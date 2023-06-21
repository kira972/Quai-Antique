<?php

namespace App\Controller\Admin;

use App\Entity\OpeningTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpeningTimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningTime::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horaire d\'ouverture')
            ->setEntityLabelInSingular('Horaires d\'ouvertures')

            ->setPageTitle("index", "Quai Antique - Administration des Horaires d\'ouverture");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            TimeField::new('lunchOpen'),
            TimeField::new('lunchClose'),
            TimeField::new('dinnerOpen'),
            TimeField::new('dinnerClose'),

        ];
    }
}