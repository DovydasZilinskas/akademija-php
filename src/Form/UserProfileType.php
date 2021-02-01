<?php

namespace App\Form;

use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('surname', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('age', NumberType::class)
            ->add('subtitle', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 10],
                'attr' => ['maxlength' => 255],
            ])
            ->add('linkedin', TextType::class, [
                'attr' => ['maxlength' => 255],
            ])
            ->add('github', TextType::class, [
                'attr' => ['maxlength' => 255],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}
