<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserProfileRepository::class)
 */
class UserProfile
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
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $surname;

    /**
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @ORM\OneToMany(targetEntity=School::class, mappedBy="userProfile")
     */
    private $Education;

    /**
     * @ORM\OneToMany(targetEntity=WorkExperience::class, mappedBy="userProfile")
     */
    private $work;

    public function __construct()
    {
        $this->Education = new ArrayCollection();
        $this->work = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection|School[]
     */
    public function getEducation(): Collection
    {
        return $this->Education;
    }

    public function addEducation(School $education): self
    {
        if (!$this->Education->contains($education)) {
            $this->Education[] = $education;
            $education->setUserProfile($this);
        }

        return $this;
    }

    public function removeEducation(School $education): self
    {
        if ($this->Education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getUserProfile() === $this) {
                $education->setUserProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WorkExperience[]
     */
    public function getWork(): Collection
    {
        return $this->work;
    }

    public function addWork(WorkExperience $work): self
    {
        if (!$this->work->contains($work)) {
            $this->work[] = $work;
            $work->setUserProfile($this);
        }

        return $this;
    }

    public function removeWork(WorkExperience $work): self
    {
        if ($this->work->removeElement($work)) {
            // set the owning side to null (unless already changed)
            if ($work->getUserProfile() === $this) {
                $work->setUserProfile(null);
            }
        }

        return $this;
    }
}
