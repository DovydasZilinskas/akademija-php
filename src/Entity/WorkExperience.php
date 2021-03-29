<?php

namespace App\Entity;

use App\Repository\WorkExperienceRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $company;

    /**
     * @ORM\Column(type="date")
     */
    private DateTime $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private DateTime $dateTo;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="work")
     */
    private $userProfile;

    /**
     * @ORM\OneToMany(targetEntity=WorkDuty::class, mappedBy="workExperience", cascade={"persist"}, orphanRemoval=true)
     */
    private $duty;

    public function __construct()
    {
        $this->duty = new ArrayCollection();
    }

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

    public function getUserProfile(): ?UserProfile
    {
        return $this->userProfile;
    }

    public function setUserProfile(?UserProfile $userProfile): self
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * @return Collection|WorkDuty[]
     */
    public function getDuty(): Collection
    {
        return $this->duty;
    }

    public function addDuty(WorkDuty $duty): self
    {
        if (!$this->duty->contains($duty)) {
            $this->duty[] = $duty;
            $duty->setWorkExperience($this);
        }

        return $this;
    }

    public function removeDuty(WorkDuty $duty): self
    {
        if ($this->duty->removeElement($duty)) {
            // set the owning side to null (unless already changed)
            if ($duty->getWorkExperience() === $this) {
                $duty->setWorkExperience(null);
            }
        }

        return $this;
    }
}
