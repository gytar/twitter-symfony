<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->$userRepo = new UserRepository();
    }

    public function load(ObjectManager $manager)
    {
       $faker = Faker\Factory::create();

       $users = array();

       for ($i = 0; $i < 10; $i++) {
           $users[$i] = new User();
           $users[$i]->setEmail($faker->email);
           $users[$i]->setPassword('$2y$13$jhO3CNIoKjWWv0mKgYHt4.EZfWYm3o1EwY9qBzUEPtDPkO//7ER8m');
           $users[$i]->setUsername($faker->userName);
           $users[$i]->setFirstname($faker->firstName);
           $users[$i]->setLastname($faker->lastName);
           $users[$i]->setBirthAt($faker->dateTime());
           $manager->persist($users[$i]);
       }

       $posts = Array();

       for ($i = 0; $i < 10; $i++){
           $posts[$i] = new Post();
           $posts[$i]->setAuthor();
           $posts[$i]->setContent($faker->sentences());
           $posts[$i]->setCreatedAt($faker->dateTime());

       }

        $manager->flush();
    }
}
