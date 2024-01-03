<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalId = null;

    #[ORM\OneToMany(mappedBy: 'studentId', targetEntity: UserStudentCourse::class)]
    private Collection $userStudentCourses;

    public function __construct()
    {
        $this->userStudentCourses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNationalId(): ?string
    {
        return $this->nationalId;
    }

    public function setNationalId(string $nationalId): static
    {
        $this->nationalId = $nationalId;

        return $this;
    }

    /**
     * @return Collection<int, UserStudentCourse>
     */
    public function getUserStudentCourses(): Collection
    {
        return $this->userStudentCourses;
    }

    public function addUserStudentCourse(UserStudentCourse $userStudentCourse): static
    {
        if (!$this->userStudentCourses->contains($userStudentCourse)) {
            $this->userStudentCourses->add($userStudentCourse);
            $userStudentCourse->setStudentId($this);
        }

        return $this;
    }

    public function removeUserStudentCourse(UserStudentCourse $userStudentCourse): static
    {
        if ($this->userStudentCourses->removeElement($userStudentCourse)) {
            // set the owning side to null (unless already changed)
            if ($userStudentCourse->getStudentId() === $this) {
                $userStudentCourse->setStudentId(null);
            }
        }

        return $this;
    }
}
