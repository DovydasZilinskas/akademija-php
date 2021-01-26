<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\DataFixtures\UserFixtures;
use App\Entity\SchoolDuty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SchoolFixtures extends Fixture implements DependentFixtureInterface
{

    public const DUTY_ID = 'duty-id';

    public function load(ObjectManager $manager)
    {
    
        for ($i = 0; $i < 5; $i++) {
            $school = new School();
            $duty = new SchoolDuty();
            $school
                ->setInstitution('Institution ' . $i)
                ->setTitle('Title ' . $i)
                ->setDateFrom(new \DateTime())
                ->setDateTo(new \DateTime())
                ->setUserProfile($this->getReference('user-id'))
                ->addDuty($duty);
            $duty->setDuty('Education no  ' . $i);
            $manager->persist($school, $duty);
        }

        $manager->flush();
        $this->addReference(self::DUTY_ID, $school);
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
