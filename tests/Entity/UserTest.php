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
            ->setPlainPassword('pa33wOrd')
        ;
    }

    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity());
    }

    public function testInvalidBlankUsername(): void
    {
        $this->assertHasErrors($this->getEntity()->setUsername(''), 1);
    }

    public function testInvalidLengthUsername(): void
    {
        $this->assertHasErrors($this->getEntity()->setUsername(str_repeat('*', 61)), 1);
    }

    public function testInvalidUniqueUsername(): void
    {
        $this->assertHasErrors($this->getEntity()->setUsername('test'), 1);
    }

    public function testInvalidBlankEmail(): void
    {
        $this->assertHasErrors($this->getEntity()->setEmail(''), 1);
    }

    public function testInvalidValueEmail(): void
    {
        $entity = $this->getEntity();

        $this->assertHasErrors($entity->setEmail('michael'), 1);
        $this->assertHasErrors($entity->setEmail('michael.coutin'), 1);
        $this->assertHasErrors($entity->setEmail('@gmail.com'), 1);
        $this->assertHasErrors($entity->setEmail('michael.coutin@gmail'), 1);
    }

    public function testInvalidUniqueEmail(): void
    {
        $this->assertHasErrors($this->getEntity()->setEmail('test@snowtricks.fr'), 1);
    }

    public function testInvalidBlankPassword(): void
    {
        $this->assertHasErrors($this->getEntity()->setPlainPassword(''), 1);
    }

    public function testInvalidValuePassword(): void
    {
        $entity = $this->getEntity();

        $this->assertHasErrors($entity->setPlainPassword('passwOrd'), 1);
        $this->assertHasErrors($entity->setPlainPassword('pa33word'), 1);
        $this->assertHasErrors($entity->setPlainPassword('pa3wOrd'), 1);
    }
}
