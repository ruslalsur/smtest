<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixture extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct() {
        $this->faker = Factory::create();
    }

    public function getDependencies()
    {
        return [
            PostFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {    
        $post = $this->getReference(PostFixture::POST_REFERENCE);  
       
        for ($i=0; $i < 2; $i++) { 
            $user = new User(
                $this->faker->firstName(),
                $this->faker->lastName()
            );
            
            $manager->persist($user); 

            $comment = new Comment(
                $this->faker->sentence(5),
                $this->faker->date(),
                $post,  
                $user  
            );
    
            $post->addComment($comment);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
