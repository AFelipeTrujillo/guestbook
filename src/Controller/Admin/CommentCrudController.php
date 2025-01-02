<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(\EasyCorp\Bundle\EasyAdminBundle\Config\Crud $crud): \EasyCorp\Bundle\EasyAdminBundle\Config\Crud
    {
        return $crud->setEntityLabelInSingular('Conference Comment')
        ->setEntityLabelInPlural('Conference Comments')
        ->setSearchFields(['author', 'text', 'email'])
        ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFilters(\EasyCorp\Bundle\EasyAdminBundle\Config\Filters $filters): \EasyCorp\Bundle\EasyAdminBundle\Config\Filters
    {
        return $filters
        ->add(EntityFilter::new('conference'))
        ->add('email');
    }

    
    public function configureFields(string $pageName): iterable
    {
        // return [
        //     IdField::new('id'),
        //     TextField::new('title'),
        //     TextEditorField::new('description'),
        // ];
        yield AssociationField::new('conference');
        yield TextField::new('author');
        yield EmailField::new('email');
        yield TextField::new('text')->hideOnIndex();
        yield TextField::new('photoFileName')->onlyOnIndex();
        $createdAt = DateTimeField::new('createdAt')
        ->setFormTypeOptions([
            'html5'=> true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text'
        ]);

        if(Crud::PAGE_EDIT == $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        } else {
            yield $createdAt;
        }
    }
    
}
