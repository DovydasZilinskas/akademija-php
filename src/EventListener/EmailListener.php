<?php

namespace App\EventListener;

use App\CustomEvent\ContactEvent;
use App\Entity\EmailList;
use Doctrine\ORM\EntityManagerInterface;

class EmailListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function registerEmail(ContactEvent $contactEvent)
    {
        $contact = $contactEvent->getMessage();

        $email = new EmailList();

        $email->setName($contact->getFullName());
        $email->setEmail($contact->getEmail());
        $email->setMessage($contact->getMessage());

        $this->entityManager->persist($email);
        $this->entityManager->flush();
    }
}
