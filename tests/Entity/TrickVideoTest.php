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
            ->setSrc('https://www.youtube.com/embed/dQw4w9WgXcQ')
            ->setTrick(new Trick())
        ;
    }

    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity());
    }
}
