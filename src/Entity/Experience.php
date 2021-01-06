<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_from;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_to;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $list_one;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $list_two;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $list_three;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDateFrom(): ?string
    {
        return $this->date_from;
    }

    public function setDateFrom(string $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateTo(): ?string
    {
        return $this->date_to;
    }

    public function setDateTo(string $date_to): self
    {
        $this->date_to = $date_to;

        return $this;
    }

    public function getListOne(): ?string
    {
        return $this->list_one;
    }

    public function setListOne(string $list_one): self
    {
        $this->list_one = $list_one;

        return $this;
    }

    public function getListTwo(): ?string
    {
        return $this->list_two;
    }

    public function setListTwo(string $list_two): self
    {
        $this->list_two = $list_two;

        return $this;
    }

    public function getListThree(): ?string
    {
        return $this->list_three;
    }

    public function setListThree(string $list_three): self
    {
        $this->list_three = $list_three;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }
}
