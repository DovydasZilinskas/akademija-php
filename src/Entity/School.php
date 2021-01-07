<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
class School
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
    private $institution;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

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
    private $ListThree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
        return $this->ListThree;
    }

    public function setListThree(string $ListThree): self
    {
        $this->ListThree = $ListThree;

        return $this;
    }
}
