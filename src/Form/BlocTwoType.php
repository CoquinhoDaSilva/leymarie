<?php

namespace App\Form;

use App\Entity\BlocTwo;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BlocTwoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Titre'
            ])
            ->add('content', CKEditorType::class, [
                'label'=>'Contenu'
            ])
            ->add('picture', FileType::class, [
                'label'=>'Image',
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
            ->add('altpicture', TextType::class, [
                'label'=> 'Description de l\'image'
            ])
            ->add('titlepicture', TextType::class, [
                'label'=>'Titre de l\'image'
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlocTwo::class,
        ]);
    }
}
