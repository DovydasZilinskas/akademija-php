<?php

namespace App\Entity;

use App\Repository\SchoolDutyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolDutyRepository::class)
 */
class SchoolDuty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $duty;

    /**
     * @ORM\ManyToOne(targetEntity=School::class, inversedBy="duty")
     */
    private $school;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuty(): ?string
    {
        return $this->duty;
    }

    public function setDuty(string $duty): self
    {
        $this->duty = $duty;

        return $this;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): self
    {
        $this->school = $school;

        return $this;
    }
}
