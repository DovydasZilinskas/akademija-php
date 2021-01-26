<?php

namespace App\DataFixtures;

use App\Entity\WorkExperience;
use App\DataFixtures\UserFixtures;
use App\Entity\WorkDuty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WorkFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $workExperience = new WorkExperience();
            $duty = new WorkDuty();
            $workExperience
                ->setPosition('Position ' . $i)
                ->setCompany('Company ' . $i)
                ->setDateFrom(new \DateTime())
                ->setDateTo(new \DateTime())
                ->setUserProfile($this->getReference('user-id'))
                ->addDuty($duty);
            $duty
                ->setDuty('Work duty no ' . $i);
            $manager->persist($workExperience);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
