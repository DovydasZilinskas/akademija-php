<?php

namespace App\DataFixtures;

use App\Entity\EmailList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmailFixtures extends Fixture
{
    public function load(ObjectManager $ob)
    {
        $ob->getConnection()->getConfiguration()->setSQLLogger(null);
        $batchSize = 1000;
        for ($i = 1; $i < 1000000; $i++) {
            $emails = new EmailList();
            $emails
                ->setEmail('test@email' . $i)
                ->setMessage('test message' . $i)
                ->setName('name' . mt_rand(1, 1000000));
                $ob->persist($emails);
            if (($i % $batchSize) === 0) {
                $ob->flush();
                $ob->commit();
                $ob->clear();
                $ob->beginTransaction();
                gc_collect_cycles();
            }
        }
        $ob->flush();
        $ob->clear();
    }
}
