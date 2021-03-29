<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $institution;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="date")
     */
    private DateTime $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private DateTime $dateTo;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="Education")
     */
    private $userProfile;

    /**
     * @ORM\OneToMany(targetEntity=SchoolDuty::class, mappedBy="school", cascade={"persist"}, orphanRemoval=true)
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
     * @return Collection|SchoolDuty[]
     */
    public function getDuty(): Collection
    {
        return $this->duty;
    }

    public function addDuty(SchoolDuty $duty): self
    {
        if (!$this->duty->contains($duty)) {
            $this->duty[] = $duty;
            $duty->setSchool($this);
        }

        return $this;
    }

    public function removeDuty(SchoolDuty $duty): self
    {
        if ($this->duty->removeElement($duty)) {
            // set the owning side to null (unless already changed)
            if ($duty->getSchool() === $this) {
                $duty->setSchool(null);
            }
        }

        return $this;
    }
}
