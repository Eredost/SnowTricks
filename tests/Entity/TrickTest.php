<?php


namespace App\Tests\Entity;


use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): Trick
    {
        return (new Trick())
            ->setName('Nose-Backflip')
            ->setDescription('Lorem dolor sit amet constrectur...')
            ->setCategory(new Category())
            ->setUser(new User())
        ;
    }
}
