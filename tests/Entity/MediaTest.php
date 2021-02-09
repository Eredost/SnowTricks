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
}
