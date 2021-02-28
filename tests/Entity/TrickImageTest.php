<?php


namespace App\Tests\Entity;


use App\Entity\Trick;
use App\Entity\TrickImage;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickImageTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): TrickImage
    {
        return (new TrickImage())
            ->setSrc('/upload/figure-placeholder.png')
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
}
