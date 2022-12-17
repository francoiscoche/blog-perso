<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Post;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use App\Repository\TagRepository;
use Doctrine\DBAL\Types\StringType;
use Doctrine\Migrations\Version\State;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Doctrine\Common\Collections\ArrayCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{

    // public function __construct(private EntityManagerInterface $entityManager)
    // {
    // }

    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        // ->setEntityLabelInSingular('Demande de contact')
        // ->setEntityLabelInPlural('Demandes de contact')
        // ->setPageTitle('index', 'SymRecipe - Administration des demandes de contact')
        // ->setPaginatorPageSize(10)
        ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            ChoiceField::new('state')->setChoices(
                static fn (?Post $post): array => $post::STATES
            ),
            TextareaField::new('content')->setFormType(CKEditorType::class),

            AssociationField::new('tags')
            ->setFormTypeOptions([
                'query_builder' => function (TagRepository $tagRepo) {
                return $tagRepo->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },
                'by_reference' => false,
            ])
        ];
    }
    
}
