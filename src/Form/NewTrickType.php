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
            ->add('trickImages', CollectionType::class, [
                'label'          => false,
                'required'       => false,
                'entry_type'     => NewTrickImageType::class,
                'entry_options'  => [
                    'label' => false,
                ],
                'allow_add'      => true,
                'allow_delete'   => true,
                'prototype'      => true,
                'by_reference'   => false,
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
