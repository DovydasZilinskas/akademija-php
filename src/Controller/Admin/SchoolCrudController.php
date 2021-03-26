<?php

namespace App\Controller\Admin;

use App\Entity\School;
use App\Form\SchoolDutyType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SchoolCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return School::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('institution'),
            TextField::new('title'),
            DateField::new('dateFrom'),
            DateField::new('dateTo'),
            CollectionField::new('Duty', 'Duties')
                ->allowAdd()
                ->allowDelete()
                ->setEntryType(SchoolDutyType::class)
                ->setFormTypeOptions([
                    'by_reference' => false
                ])
        ];
    }
}
