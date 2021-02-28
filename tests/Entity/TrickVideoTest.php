<?php


namespace App\Tests\Entity;


use App\Entity\Trick;
use App\Entity\TrickVideo;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickVideoTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): TrickVideo
    {
        return (new TrickVideo())
            ->setSrc('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->setTrick(new Trick())
            ;
    }

    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity());
    }

    public function testInvalidBlankSrc(): void
    {
        $this->assertHasErrors($this->getEntity()->setSrc(''), 1);
    }

    public function testInvalidLengthSrc(): void
    {
        $this->assertHasErrors($this->getEntity()->setSrc('http://www.' . str_repeat('a', 256) . '.fr'), 1);
    }

    public function testInvalidValueSrc(): void
    {
        $entity = $this->getEntity();

        $this->assertHasErrors($entity->setSrc('github'), 1);
        $this->assertHasErrors($entity->setSrc('www.github'), 1);
        $this->assertHasErrors($entity->setSrc('.fr'), 1);
    }
}
