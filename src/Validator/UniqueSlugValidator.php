<?php

namespace App\Validator;

use App\Repository\TrickRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueSlugValidator extends ConstraintValidator
{
    private const NOT_ALLOWED_SLUG = [
        'new',
        'edit',
    ];

    /** @var SluggerInterface $slugger */
    private $slugger;

    /** @var TrickRepository $trickRepository */
    private $trickRepository;

    public function __construct(SluggerInterface $slugger, TrickRepository $trickRepository)
    {
        $this->slugger = $slugger;
        $this->trickRepository = $trickRepository;
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var $constraint \App\Validator\UniqueSlug */

        if (null === $value
            || '' === $value
            || $this->trickRepository->findOneBy(['name' => $value])) {
            return;
        }

        if (in_array($value, self::NOT_ALLOWED_SLUG, false)
            || $this->trickRepository->findOneBy(['slug' => $this->slugger->slug($value)])) {
            $this->context->buildViolation($constraint->message)
                ->addViolation()
            ;
        }
    }
}
