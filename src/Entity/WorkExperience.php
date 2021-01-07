<?php

namespace App\Entity;

use App\Repository\WorkExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkExperienceRepository::class)
 */
class WorkExperience
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
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listThree;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getListOne(): ?string
    {
        return $this->listOne;
    }

    public function setListOne(string $listOne): self
    {
        $this->listOne = $listOne;

        return $this;
    }

    public function getListTwo(): ?string
    {
        return $this->listTwo;
    }

    public function setListTwo(string $listTwo): self
    {
        $this->listTwo = $listTwo;

        return $this;
    }

    public function getListThree(): ?string
    {
        return $this->listThree;
    }

    public function setListThree(string $listThree): self
    {
        $this->listThree = $listThree;

        return $this;
    }
}
