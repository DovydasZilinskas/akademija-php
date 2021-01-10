<?php

namespace App\DataFixtures;

use App\Entity\School;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SchoolFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $school = new School();
            $school
                ->setInstitution('Institution ' . $i)
                ->setTitle('Title ' . $i)
                ->setDateFrom(new \DateTime())
                ->setDateTo(new \DateTime())
                ->setListOne('List item 1 ' . $i)
                ->setListTwo('List item 2 ' . $i)
                ->setListThree('List item 3 ' . $i);
            $manager->persist($school);
        }

        $manager->flush();
    }
}
