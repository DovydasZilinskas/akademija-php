<?php

namespace App\Form;

use App\Entity\WorkExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', TextType::class)
            ->add('company', TextType::class)
            ->add('dateFrom', DateType::class)
            ->add('dateTo', DateType::class)
            ->add('listOne', TextType::class)
            ->add('listTwo', TextType::class)
            ->add('listThree', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorkExperience::class,
        ]);
    }
}
