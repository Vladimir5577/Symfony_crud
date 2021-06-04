<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = Factory::create();

        for ($i = 0; $i <= 5; $i++) {
            $article = new Article();
            $article->setTitle($generator->title);
            $article->setDescription($generator->text(200));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
