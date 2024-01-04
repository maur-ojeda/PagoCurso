<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalId = null;

    #[ORM\Column(length: 255)]
    private ?string $userType = null;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: UserStudentCourse::class)]
    private Collection $userStudentCourses;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Log::class)]
    private Collection $logs;

    public function __construct()
    {
        $this->userStudentCourses = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

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



    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): static
    {
        $this->userType = $userType;

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
            $userStudentCourse->setUserId($this);
        }

        return $this;
    }

    public function removeUserStudentCourse(UserStudentCourse $userStudentCourse): static
    {
        if ($this->userStudentCourses->removeElement($userStudentCourse)) {
            // set the owning side to null (unless already changed)
            if ($userStudentCourse->getUserId() === $this) {
                $userStudentCourse->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Log>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): static
    {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
            $log->setUserId($this);
        }

        return $this;
    }

    public function removeLog(Log $log): static
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getUserId() === $this) {
                $log->setUserId(null);
            }
        }

        return $this;
    }
}
