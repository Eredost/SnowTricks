<?php


namespace App\Tests\Entity;


use App\Entity\Category;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): Category
    {
        return (new Category())
            ->setName('Flip')
        ;
    }
}
