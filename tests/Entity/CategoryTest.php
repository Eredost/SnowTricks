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
            ->setName('Flop')
        ;
    }

    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity());
    }

    public function testInvalidBlankName(): void
    {
        $this->assertHasErrors($this->getEntity()->setName(''), 1);
    }

    public function testInvalidLengthName(): void
    {
        $this->assertHasErrors($this->getEntity()->setName(str_repeat('*', 61)), 1);
    }

    public function testInvalidUniqueName(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('Flip'), 1);
    }
}
