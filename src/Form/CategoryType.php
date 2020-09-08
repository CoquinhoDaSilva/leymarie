<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\DBAL\Types\BooleanType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom de la catégorie',
                'attr'=>['placeholder'=>'Nom']
            ])
            ->add('picture', FileType::class, [
                'label'=>'Image',
                'attr'=>['placeholder'=>'Image'],
                'mapped'=>false,
                'required'=>false,
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Seul les fichiers de type jpg, jpeg et png sont acceptés',
                    ])
                ]
            ])
            ->add('wording', CKEditorType::class, [
                'label'=>'Description',
                'attr'=>['placeholder'=>'Description']
            ])
            ->add('active', CheckboxType::class, [
                'label'=>'Afficher dans les tarifs ?',
                'required' => false

            ])
            ->add('submit', SubmitType::class, [
                'attr'=>['placeholder'=>'Valider']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
