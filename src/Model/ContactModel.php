<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ContactModel
{
    /**
     * @Assert\NotBlank
     */
    private ?string $fullName = '';

    /**
     * @Assert\NotBlank
     */
    private ?string $email = '';

    /**
     * @Assert\NotBlank
     */
    private ?string $message = '';

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setEmail(?string $email): self
    {

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {

        return $this->email;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
