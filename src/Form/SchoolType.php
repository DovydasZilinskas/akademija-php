<?php

namespace App\Form;

use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution')
            ->add('title')
            ->add('dateFrom')
            ->add('dateTo')
            ->add('listOne')
            ->add('listTwo')
            ->add('ListThree');
        // ->add('userProfile');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => School::class,
        ]);
    }
}
