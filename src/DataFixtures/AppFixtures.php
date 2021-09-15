<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker = Faker\Factory::create();

       $users = Array();

       for ($i = 0; $i < 10; $i++) {
           $users[$i] = new User();
           $users[$i]->setEmail($faker->email);
           $users[$i]->setPassword('PASSWORD');
           $users[$i]->setUsername($faker->name);
           $manager->persist($users[$i]);
       }


        $manager->flush();
    }
}
