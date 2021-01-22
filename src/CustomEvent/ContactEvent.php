<?php

namespace App\CustomEvent;

use App\Model\ContactModel;
use Symfony\Contracts\EventDispatcher\Event;

class ContactEvent extends Event
{
    public const NAME = 'contact.message';

    protected $contact;

    public function __construct(ContactModel $contact)
    {
        $this->contact = $contact;
    }

    public function getMessage()
    {
        return $this->contact;
    }
}
