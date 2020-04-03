<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Titre'
            ])
            ->add('content', TextType::class, [
                'label'=>'Article'
            ])
            ->add('picture', FileType::class, [
                'label'=>'Image',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('date', DateType::class, [
                'label'=>'Date',
                'widget'=>'single_text'
            ])
            ->add('user', EntityType::class, [
                'class'=>User::class,
                'choice_label'=> function (User $user) {
                    return $user->getFirstname() . ' ' . $user->getName();
                }
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
