<?php

namespace App\Controller\Admin;

use App\Entity\ForumPosts;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ForumPostsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ForumPosts::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setLabel('ID du topic')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('author')->setLabel('Auteur'),
            TextField::new('forumlink')->setLabel('Lien du Forum'),
            TextEditorField::new('description')->setLabel('Description'),
        ];
    }
}
