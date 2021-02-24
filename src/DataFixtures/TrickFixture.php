<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\TrickProvider;
use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class TrickFixture extends AbstractFixture implements DependentFixtureInterface
{
    /** @var SluggerInterface $slugger */
    private $slugger;

    /**
     * @Required
     * @param SluggerInterface $slugger
     */
    public function setSlugger(SluggerInterface $slugger): void
    {
        $this->slugger = $slugger;
    }

    protected function loadData(ObjectManager $manager): void
    {
        $tricks = TrickProvider::getTricksSortedByCategories();

        foreach ($tricks as $categoryName => $figures) {
            // Add categories
            $category = (new Category())
                ->setName($categoryName)
                ->setCreatedAt($this->faker->dateTimeBetween('-3 months', '-2 months'))
            ;
            $manager->persist($category);

            // Add the tricks linked to the categories
            $this->createMany(count($figures), 'tricks_'.$categoryName, function ($count) use ($figures, $category) {
                $trick = (new Trick())
                    ->setName($figures[$count])
                    ->setSlug($this->slugger->slug($figures[$count]))
                    ->setDescription($this->faker->paragraphs(3, true))
                    ->setCategory($category)
                    ->setUser($this->getRandomReference('main_user'))
                    ->setCreatedAt($this->faker->dateTimeBetween('-2 months', '-30 days'))
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
