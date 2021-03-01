<?php

namespace App\Form;

use App\Entity\TrickImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class NewTrickImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label'       => false,
                'constraints' => [
                    new File([
                        'maxSize'          => '2M',
                        'maxSizeMessage'   => 'La taille du fichier est trop importante, celle-ci ne doit pas excéder {{ limit }} {{ suffix }}',
                        'mimeTypes'        => [
                            'image/png',
                            'image/jpeg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Le type de fichier est invalide, les extensions autorisées sont {{ types }}',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrickImage::class,
        ]);
    }
}
