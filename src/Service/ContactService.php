<?php

namespace App\Service;

use App\Model\ContactModel;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessage(ContactModel $contact)
    {
        

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
