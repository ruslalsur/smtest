<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixture extends Fixture
{
    public const POST_REFERENCE = 'only-one-post';

    private $faker;

    public function __construct() {
        $this->faker = Factory::create('ru_RU');
    }

    public function load(ObjectManager $manager)
    { 
        $post = new Post(
            $this->faker->sentence(6),
            $this->faker->sentence(200)
        );

        $manager->persist($post);
        $manager->flush();  

        $this->addReference(self::POST_REFERENCE, $post);
    }
    
}
