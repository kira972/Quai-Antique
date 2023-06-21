<?php

namespace App\Controller\Admin;


use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Photos')
            ->setEntityLabelInSingular('Photo')

            ->setPageTitle("index", "Quai Antique - Administration des Photos");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            // IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            BooleanField::new('isFavorite'),
            BooleanField::new('isShowingInGallery'),
            TextField::new('filename')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('filename', "File")
            ->setUploadDir("public/uploads/images")
            ->setBasePath('uploads/images'),
            AssociationField::new('product')
        ];
    }
}