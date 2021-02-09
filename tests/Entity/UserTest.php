<?php


namespace App\Tests\Entity;


use App\Entity\User;
use App\Tests\Entity\Traits\AssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    use AssertsTrait;

    protected function getEntity(): User
    {
        return (new User())
            ->setUsername('Michaël')
            ->setEmail('michael.coutin62@gmail.com')
            ->setPassword('$2y$10$RVtS8QwhLCZch2GSFgHTBO1PXOFIde65IlxR2vNd./m6p595QrqDa')
            ->setIsValidated(true)
        ;
    }
}
