<?php

namespace App\Form;

use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserType extends AbstractType
{
    /** @var UserRepository $repository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom d\'utilisateur ne peut pas être vide',
                    ]),
                    new Length([
                        'max'        => 60,
                        'maxMessage' => 'Le nom d\'utilisateur ne peut pas dépasser {{ limit }} caractères',
                    ]),
                    new Callback(function ($username, ExecutionContextInterface $context) {
                        if (!$user = $this->repository->findOneBy(['username' => $username])) {
                            $context->buildViolation('Ce nom d\'utilisateur n\'existe pas')
                                ->atPath('username')
                                ->addViolation()
                            ;
                        }
                        if (!$user->getIsValidated()) {
                            $context->buildViolation('Vous devez avoir validé votre adresse email avant de pouvoir réinitialiser votre mot de passe')
                                ->atPath('username')
                                ->addViolation()
                            ;
                        }
                    })
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
