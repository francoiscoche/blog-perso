<?php

namespace App\Controller\Admin;

use App\Entity\Til;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Til::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextareaField::new('text')->setFormType(CKEditorType::class),
        ];
    }

}
