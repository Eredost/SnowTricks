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
        $this->assertHasErrors($this->getEntity()->setName(str_repeat('*', 121)), 1);
    }

    public function testInvalidUniqueName(): void
    {
        $this->assertHasErrors($this->getEntity()->setName('Nose-pick'), 1);
    }

    public function testInvalidBlankDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
    }

    public function testInvalidLengthDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(str_repeat('*', 5001)), 1);
    }
}
