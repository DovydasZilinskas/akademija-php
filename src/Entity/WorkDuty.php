<?php

namespace App\Entity;

use App\Repository\WorkDutyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkDutyRepository::class)
 */
class WorkDuty
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
     * @ORM\ManyToOne(targetEntity=WorkExperience::class, inversedBy="duty")
     */
    private $workExperience;

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

    public function getWorkExperience(): ?WorkExperience
    {
        return $this->workExperience;
    }

    public function setWorkExperience(?WorkExperience $workExperience): self
    {
        $this->workExperience = $workExperience;

        return $this;
    }
}
