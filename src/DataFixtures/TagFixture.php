<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tag;
use Faker\Factory;

class TagFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator  = Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            $tag = new Tag();
            $tag->setName($generator->realText(20));
            $tag->setSlug($generator->slug());
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
