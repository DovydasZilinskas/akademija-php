<?php

namespace App\EventListener;

use App\CustomEvent\ContactEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ContactListener
{
    private $mailer;
        
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessage(ContactEvent $contactEvent)
    {
        $contact = $contactEvent->getMessage();

        $message = (new Email())
        ->from('info@info.info')
        ->to($contact->getEmail())
        ->subject('You got mail from your portfolio page')
        ->text(
            'Sender : ' . $contact->getEmail() . \PHP_EOL .
                $contact->getMessage(),
            'text/plain'
        );

        $this->mailer->send($message);
    }
}
