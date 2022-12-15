<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use App\DataFixtures\PostFixtures;
use App\Repository\PostRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture
{

    public function __construct(private PostRepository $postRepository)
    {
    }
    
    /**
     * Create fake tag related to posts
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $posts = $this->postRepository->findAll();
        $tags = [];
        
        for ($i=0; $i < 10 ; $i++) {

            $tag = new Tag();
            $tag->setName($faker->words(1, true));
            $manager->persist($tag);
            $tags[] = $tag;
        }

        foreach($posts as $post)
        {
            for ($i=0; $i < mt_rand(1,5) ; $i++) { 
                $post->addTag(
                    $tags[mt_rand(0, count($tags) - 1)]
                );
            }
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PostFixtures::class];
    }
}
