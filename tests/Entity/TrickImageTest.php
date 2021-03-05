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
            ->setSrc('figure-placeholder.png')
            ->setTrick(new Trick())
        ;
    }

    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity());
    }
}
