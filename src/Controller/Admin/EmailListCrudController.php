<?php

namespace App\Controller\Admin;

use App\Entity\EmailList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmailListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EmailList::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
