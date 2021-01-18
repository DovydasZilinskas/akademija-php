<?php

namespace App\Model;

class ContactModel
{
    private string $fullName = '';

    private string $email = '';

    private string $message = '';

    public function setFullName(string $fullName): self
    {

        $this->fullName = $fullName;

        return $this;
    }

    public function getFullName(): string
    {

        return $this->fullName;
    }

    public function setEmail(string $email): self
    {

        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {

        return $this->email;
    }

    public function setMessage(string $message): self
    {

        $this->message = $message;

        return $this;
    }

    public function getMessage(): string
    {

        return $this->message;

    }
}
