<?php


namespace App\Tests\Entity;


use App\Entity\Media;
use App\Entity\Trick;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): Media
    {
        return (new Media())
            ->setSrc('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->setType('video')
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
        $this->assertHasErrors($this->getEntity()->setSrc(str_repeat('a', 256)), 1);
    }

    public function testInvalidBlankType(): void
    {
        $this->assertHasErrors($this->getEntity()->setType(''), 1);
    }

    public function testInvalidLengthType(): void
    {
        $this->assertHasErrors($this->getEntity()->setType(str_repeat('a', 61)), 1);
    }
}
