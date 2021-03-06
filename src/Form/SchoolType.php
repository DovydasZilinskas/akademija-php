<?php

namespace App\Form;

use App\Entity\School;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('title', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('dateFrom', DateType::class, [
                'years' => range(date('Y')-20, date('Y')+30),
            ])
            ->add('dateTo', DateType::class, [
                'years' => range(date('Y')-20, date('Y')+30),
            ])
            ->add('duty', CollectionType::class, [
                'label' => false,
                'entry_type' => SchoolDutyType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => School::class,
        ]);
    }
}
