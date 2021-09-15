<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
       $faker = Faker\Factory::create();

       $users = array();

       for ($i = 0; $i < 5; $i++) {
           $users[$i] = new User();
           $users[$i]->setEmail($faker->email);
           $users[$i]->setPassword('$2y$13$jhO3CNIoKjWWv0mKgYHt4.EZfWYm3o1EwY9qBzUEPtDPkO//7ER8m');
           $users[$i]->setUsername($faker->userName);
           $users[$i]->setFirstname($faker->firstName);
           $users[$i]->setLastname($faker->lastName);
           $users[$i]->setBirthAt($faker->dateTime());
           $users[$i]->setPicture($faker->imageUrl());
           $manager->persist($users[$i]);
       }

       $posts = Array();

       for ($i = 0; $i < 20; $i++){
           $posts[$i] = new Post();
           $posts[$i]->setAuthor($users[random_int(0, count($users) -1)]);
           $posts[$i]->setContent($faker->sentence());
           $posts[$i]->setCreatedAt($faker->dateTime());
           $manager->persist($posts[$i]);
       }

        $comments = Array();

        for ($i = 0; $i < 20; $i++){
            $comments[$i] = new Comment();
            $comments[$i]->setAuthor($users[random_int(0, count($users) -1)]);
            $comments[$i]->setPost($posts[random_int(0, count($posts) -1)]);
            $comments[$i]->setContent($faker->sentence);
            $manager->persist($comments[$i]);
        }

        $manager->flush();
    }
}
