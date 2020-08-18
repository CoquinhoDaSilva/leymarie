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
                'label'=>'Adresse Email'
            ])
            ->add('firstname', TextType::class, [
                'label'=>'Prénom'
            ])
            ->add('name', TextType::class, [
                'label'=>'Nom'
            ])
            ->add('phone', TextType::class, [
                'required'=>false,
                'label'=>'Numéro de Téléphone'
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Les mots de passe doivent être identiques',
                'label'=>'Mot de passe',
                'required'=>true,
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Confirmer mot de passe']
            ])
            ->add('submit', submitType::class, [
                'label'=>'S\'enregistrer',
                'attr'=>['class'=>'btn1']
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
