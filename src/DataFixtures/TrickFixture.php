<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\TrickProvider;
use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrickFixture extends AbstractFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager): void
    {
        $tricks = TrickProvider::getTricksSortedByCategories();

        foreach ($tricks as $categoryName => $figures) {
            // Add categories
            $category = (new Category())
                ->setName($categoryName)
            ;
            $manager->persist($category);

            // Add the tricks linked to the categories
            $this->createMany(count($figures), 'tricks_'.$categoryName, function ($count) use ($figures, $category) {
                $trick = (new Trick())
                    ->setName($figures[$count])
                    ->setDescription($this->faker->paragraphs(3, true))
                    ->setCategory($category)
                    ->setUser($this->getRandomReference('main_user'))
                ;

                return $trick;
            });
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}
