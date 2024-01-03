<?php

namespace App\Entity;

use App\Repository\UserStudentCourseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserStudentCourseRepository::class)]
class UserStudentCourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userStudentCourses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'userStudentCourses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $studentId = null;

    #[ORM\ManyToOne(inversedBy: 'userStudentCourses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $courseId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getStudentId(): ?Student
    {
        return $this->studentId;
    }

    public function setStudentId(?Student $studentId): static
    {
        $this->studentId = $studentId;

        return $this;
    }

    public function getCourseId(): ?Course
    {
        return $this->courseId;
    }

    public function setCourseId(?Course $courseId): static
    {
        $this->courseId = $courseId;

        return $this;
    }
}
