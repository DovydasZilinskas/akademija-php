<?php

namespace App\DataFixtures;

use App\Entity\EmailList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmailFixtures extends Fixture
{
    public function load(ObjectManager $ob)
    {
        $batchSize = 1000;
        for ($i = 0; $i < 10000; $i++) {
            $emails = new EmailList();
            $emails
                ->setEmail('test@email')
                ->setMessage('test message' . $i)
                ->setName('test' . $i);
                $ob->persist($emails);
            if (($i % $batchSize) === 0) {
                $ob->flush();
                $ob->clear();
            }
        }
        $ob->flush();
        $ob->clear();
    }
}
