<?php

namespace App\DataFixtures;

use App\Entity\WorkExperience;
use App\DataFixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $workExperience = new WorkExperience();
            $workExperience
                ->setPosition('Position ' . $i)
                ->setCompany('Company ' . $i)
                ->setDateFrom(new \DateTime())
                ->setDateTo(new \DateTime())
                ->setListOne('List item 1 ' . $i)
                ->setListTwo('List item 2 ' . $i)
                ->setListThree('List item 3 ' . $i)
                ->setUserProfile($this->getReference(UserFixtures::USER_ID));
            $manager->persist($workExperience);
        }

        $manager->flush();
    }
}
