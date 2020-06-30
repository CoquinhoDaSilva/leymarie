<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'=>['placeholder'=>'Email'],
                'constraints'=> [
                    new NotBlank(['message'=>'Veuillez renseigner une adresse mail valide'])
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr'=>['placeholder'=>'Prénom'],
                'constraints'=>[
                    new NotBlank(['message'=>'Veuillez renseigner un prénom'])
                ]
            ])
            ->add('name', TextType::class, [
                'attr'=>['placeholder'=>'Nom'],
                'constraints'=> [
                    new NotBlank(['message'=>'Veuillez renseigner un nom'])
                ]
            ])
            ->add('phone', TextType::class, [
                'required'=>false,
                'attr'=>['placeholder'=>'Téléphone']
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Les mots de passe doivent être identiques',
                'attr'=>['placeholder'=>'Mot de passe'],
                'required'=>true,
                'constraints'=> [
                    new NotBlank(['message'=>'Veuillez renseigner un mot de passe'])
                ],
                'first_options'=> [
                    'attr'=>['placeholder'=>'Mot de passe'],
                    'label'=>false],
                'second_options'=> [
                    'attr'=>['placeholder'=>'Confirmation mot de passe'],
                    'label'=>false]
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
