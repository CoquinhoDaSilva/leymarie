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
                'label'=>'Email'
            ])
            ->add('password')
            ->add('firstname', TextType::class, [
                'label'=>'Prénom'
            ])
            ->add('name', TextType::class, [
                'label'=>'Nom'
            ])
            ->add('phone', TextType::class, [
                'label'=>'Téléphone',
                'required'=>false
            ])
            ->add('password', PasswordType::class, [
                'label'=>'Mot de passe'
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
