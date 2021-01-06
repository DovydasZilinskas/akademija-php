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

    public function setDateFrom(string $dateFrom): self
    {
        $this->date_from = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?string
    {
        return $this->date_to;
    }

    public function setDateTo(string $dateTo): self
    {
        $this->date_to = $dateTo;

        return $this;
    }

    public function getListOne(): ?string
    {
        return $this->list_one;
    }

    public function setListOne(string $listOne): self
    {
        $this->list_one = $listOne;

        return $this;
    }

    public function getListTwo(): ?string
    {
        return $this->list_two;
    }

    public function setListTwo(string $listTwo): self
    {
        $this->list_two = $listTwo;

        return $this;
    }

    public function getListThree(): ?string
    {
        return $this->list_three;
    }

    public function setListThree(string $listThree): self
    {
        $this->list_three = $listThree;

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
