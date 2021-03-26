<?php

namespace App\Controller\Admin;

use App\Entity\WorkExperience;
use App\Form\WorkDutyType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkExperience::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('position'),
            TextField::new('company'),
            DateField::new('dateFrom'),
            DateField::new('dateTo'),
            CollectionField::new('Duty', 'Duties')
                ->allowAdd()
                ->allowDelete()
                ->setEntryType(WorkDutyType::class)
                ->setFormTypeOptions([
                    'by_reference' => false
                ])
        ];
    }
}
