<?php


namespace App\Tests\Entity;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): Comment
    {
        return (new Comment())
            ->setContent('Lorem dolor sit amet')
            ->setUser(new User())
            ->setTrick(new Trick())
        ;
    }
}
