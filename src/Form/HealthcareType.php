<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Healthcare;
use App\Entity\Price;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class HealthcareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wording', TextType::class, [
                'label'=>'Libellé'
            ])
            ->add('price', MoneyType::class, [
                'label'=>'Prix'
            ])
            ->add('category', EntityType::class, [
                'class'=>Category::class,
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Healthcare::class,
        ]);
    }
}
