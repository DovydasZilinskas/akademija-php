<?php

namespace App\DataFixtures;

use App\Entity\UserProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $userProfile = new UserProfile();
        $userProfile
            ->setName('Dovydas')
            ->setSurname('Zilinskas')
            ->setAge(mt_rand(10, 100));
        $manager->persist($userProfile);


        $manager->flush();
    }
}
