<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $academicYear = null;

    #[ORM\Column(length: 255)]
    private ?string $level = null;

    #[ORM\Column(length: 3)]
    private ?string $section = null;

    #[ORM\OneToMany(mappedBy: 'courseId', targetEntity: UserStudentCourse::class, orphanRemoval: true)]
    private Collection $userStudentCourses;

    public function __construct()
    {
        $this->userStudentCourses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcademicYear(): ?int
    {
        return $this->academicYear;
    }

    public function setAcademicYear(int $academicYear): static
    {
        $this->academicYear = $academicYear;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): static
    {
        $this->section = $section;

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
            $userStudentCourse->setCourseId($this);
        }

        return $this;
    }

    public function removeUserStudentCourse(UserStudentCourse $userStudentCourse): static
    {
        if ($this->userStudentCourses->removeElement($userStudentCourse)) {
            // set the owning side to null (unless already changed)
            if ($userStudentCourse->getCourseId() === $this) {
                $userStudentCourse->setCourseId(null);
            }
        }

        return $this;
    }
}
