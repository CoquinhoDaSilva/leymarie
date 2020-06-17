<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'=>['placeholder'=>'Email']
            ])
            ->add('firstname', TextType::class, [
                'attr'=>['placeholder'=>'Prénom']
            ])
            ->add('name', TextType::class, [
                'attr'=>['placeholder'=>'Nom']
            ])
            ->add('phone', TextType::class, [
                'required'=>false,
                'attr'=>['placeholder'=>'Téléphone']
            ])
            ->add('password', PasswordType::class, [
                'attr'=>['placeholder'=>'Mot de passe']
            ])
            ->add('submit', submitType::class, [
                'label'=>'S\'enregistrer'
    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
