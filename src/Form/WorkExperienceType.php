<?php

namespace App\Form;

use App\Entity\WorkExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('company')
            ->add('dateFrom')
            ->add('dateTo')
            ->add('listOne')
            ->add('listTwo')
            ->add('listThree')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorkExperience::class,
        ]);
    }
}
