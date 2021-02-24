<?php

namespace App\DataFixtures;

use App\Entity\UserProfile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER_PROFILE_REFERENCE = 'user-id';

    public function load(ObjectManager $om)
    {
        $user = new UserProfile();
        $user
            ->setAge('30')
            ->setDescription('
            Started as a sound tech now I am going through developer career and leaving music as a side hobby and passion.')
            ->setEmail('dovydas.zilinsk@gmail.com')
            ->setGithub('@github: DovydasZilinskas')
            ->setLinkedin('@linkedin: d-zilinskas')
            ->setName('Dovydas')
            ->setSubtitle('Beginner frontend developer')
            ->setSurname('Žilinskas');
        $om->persist($user);
        $om->flush();
        $this->addReference(self::USER_PROFILE_REFERENCE, $user);
    }
}
