<?php

namespace App\DataFixtures;

use App\Entity\UserProfile;
use App\Entity\School;
use App\Entity\WorkExperience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $userProfile = new UserProfile();
            $userProfile
                ->setName('Name ' . $i)
                ->setSurname('Surname ' . $i)
                ->setAge(mt_rand(10, 100));
            $manager->persist($userProfile);
        }

        $manager->flush();
    }
}
