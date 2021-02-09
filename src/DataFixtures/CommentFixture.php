<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixture extends AbstractFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager): void
    {
        $tricks = $this->getReferences('tricks');

        foreach ($tricks as $trick) {
            $this->createMany(3, 'comment_'.$trick->getName(), function () use ($trick) {
                $comment = (new Comment())
                    ->setContent($this->faker->text())
                    ->setUser($this->getRandomReference('main_user'))
                    ->setTrick($trick)
                ;

                return $comment;
            });

            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            TrickFixture::class,
        ];
    }
}
