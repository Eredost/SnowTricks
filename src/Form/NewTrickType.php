<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewTrickType extends AbstractType
{
    /** @var SluggerInterface $slugger */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('images', CollectionType::class, [
                'label' => false,
                'mapped'         => false,
                'required'       => false,
                'entry_type'     => NewImageType::class,
                'entry_options'  => [
                    'label' => false,
                ],
                'allow_add'      => true,
                'allow_delete'   => true,
                'prototype'      => true,
                'prototype_name' => 'new_trick_image',
            ])
            ->add('category')
            ->addEventListener(
                FormEvents::POST_SUBMIT,
                [$this, 'onPostSubmit']
            )
        ;
    }

    public function onPostSubmit(FormEvent $event): void
    {
        $trick = $event->getData();
        $trick->setSlug($this->slugger->slug($trick->getName()));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
