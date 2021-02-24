<?php

namespace App\DataFixtures;

use App\DataFixtures\UserFixtures;
use App\Entity\WorkDuty;
use App\Entity\WorkExperience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WorkExperienceFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
    
        $work = new WorkExperience();
        $work2 = new WorkExperience();
        $duty = new WorkDuty();
        $duty2 = new WorkDuty();
        $duty3 = new WorkDuty();
        $duty4 = new WorkDuty();
        $duty5 = new WorkDuty();

        //first work experience row

        $duty
            ->setDuty('Live sound event service');
        $manager->persist($duty);

        $duty2
            ->setDuty('Sound system and equipment maintenance');
        $manager->persist($duty2);

        $work
            ->setCompany('MEX Pro')
            ->setPosition('Sound Technician')
            ->setDateFrom(new \DateTime('2018-12-01T15:00:00'))
            ->setDateTo(new \DateTime('2020-06-01T15:00:00'))
            ->setUserProfile($this->getReference(UserFixtures::USER_PROFILE_REFERENCE))
            ->addDuty($duty)
            ->addDuty($duty2);
        $manager->persist($work);

        //second work experience row

        $duty3
            ->setDuty('Cinema management and maintenance');
        $manager->persist($duty3);

        $duty4
            ->setDuty('Recording studio and live sound');
        $manager->persist($duty4);

        $duty5
            ->setDuty('Non-formal education of children');
        $manager->persist($duty5);

        $work2
            ->setCompany('Varena Culture Center')
            ->setPosition('Cinema and Sound technician')
            ->setDateFrom(new \DateTime('2015-03-01T15:00:00'))
            ->setDateTo(new \DateTime('2018-11-01T15:00:00'))
            ->setUserProfile($this->getReference(UserFixtures::USER_PROFILE_REFERENCE))
            ->addDuty($duty3)
            ->addDuty($duty4)
            ->addDuty($duty5);
        $manager->persist($work2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
