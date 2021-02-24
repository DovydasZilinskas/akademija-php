<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\DataFixtures\UserFixtures;
use App\Entity\SchoolDuty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EducationFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
    
        $school = new School();
        $school2 = new School();
        $school3 = new School();
        $duty = new SchoolDuty();
        $duty2 = new SchoolDuty();
        $duty3 = new SchoolDuty();
        $duty4 = new SchoolDuty();
        $duty5 = new SchoolDuty();
        $duty6 = new SchoolDuty();

        //first education row

        $duty
            ->setDuty('Frontend React, Vue.js frameworks');
        $manager->persist($duty);

        $duty2
            ->setDuty('Backend Node.js');
        $manager->persist($duty2);

        $school
            ->setInstitution('CodeAcademy')
            ->setTitle('Front-End studies')
            ->setDateFrom(new \DateTime('2020-06-01T15:00:00'))
            ->setDateTo(new \DateTime('2020-12-01T15:00:00'))
            ->setUserProfile($this->getReference(UserFixtures::USER_PROFILE_REFERENCE))
            ->addDuty($duty)
            ->addDuty($duty2);
        $manager->persist($school);

        //second education row

        $duty3
            ->setDuty('Music composition');
        $manager->persist($duty3);

        $duty4
            ->setDuty('Sound synthesis');
        $manager->persist($duty4);

        $school2
            ->setInstitution('LMTA')
            ->setTitle('Master\'s degree, Music Composition')
            ->setDateFrom(new \DateTime('2020-09-01T15:00:00'))
            ->setDateTo(new \DateTime('2021-12-01T15:00:00'))
            ->setUserProfile($this->getReference(UserFixtures::USER_PROFILE_REFERENCE))
            ->addDuty($duty3)
            ->addDuty($duty4);
        $manager->persist($school2);

        //third education row

        $duty5
            ->setDuty('Live, recording, radio sound');
        $manager->persist($duty5);

        $duty6
            ->setDuty('Music composition, harmony, audiovisual arts');
        $manager->persist($duty6);

        $school3
            ->setInstitution('KTU')
            ->setTitle('Bachelor\'s degree, Music Technology')
            ->setDateFrom(new \DateTime('2009-09-01T15:00:00'))
            ->setDateTo(new \DateTime('2013-06-01T15:00:00'))
            ->setUserProfile($this->getReference(UserFixtures::USER_PROFILE_REFERENCE))
            ->addDuty($duty5)
            ->addDuty($duty6);
        $manager->persist($school3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
