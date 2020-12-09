<?php

namespace App\DataFixtures;

use App\Project\Domain\Article\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= 50; $i++) {
            $article = new Article();

            $article->setContributors(
                new ArrayCollection([$this->getReference(UserFixtures::TEST_USER)])
            );

            $article->setAuthor($this->getReference(UserFixtures::TEST_USER));
            $article->setBody($faker->paragraph);
            $article->setTitle($faker->sentence);

            $manager->persist($article);
            $manager->flush();
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
