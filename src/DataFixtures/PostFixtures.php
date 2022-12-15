<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Post;


class PostFixtures extends Fixture
{

    /**
     * Create fake posts
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        for ($i=0; $i < 50; $i++) {
            $post = new Post();
            $post->setTitle($faker->words(4, true))
                ->setContent($faker->realText(1800))
                ->setState(mt_rand(0, 2) === 1 ? Post::STATES[0] : Post::STATES[1]);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
