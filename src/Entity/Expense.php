<?php

namespace App\Entity;

use App\Repository\ExpenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseRepository::class)]
class Expense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $expenseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $expenseConcept = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpecialEvent $spacialEventId = null;

    #[ORM\OneToMany(mappedBy: 'expenseId', targetEntity: Attachment::class)]
    private Collection $attachments;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getExpenseDate(): ?\DateTimeInterface
    {
        return $this->expenseDate;
    }

    public function setExpenseDate(\DateTimeInterface $expenseDate): static
    {
        $this->expenseDate = $expenseDate;

        return $this;
    }

    public function getExpenseConcept(): ?string
    {
        return $this->expenseConcept;
    }

    public function setExpenseConcept(string $expenseConcept): static
    {
        $this->expenseConcept = $expenseConcept;

        return $this;
    }

    public function getSpacialEventId(): ?SpecialEvent
    {
        return $this->spacialEventId;
    }

    public function setSpacialEventId(?SpecialEvent $spacialEventId): static
    {
        $this->spacialEventId = $spacialEventId;

        return $this;
    }

    /**
     * @return Collection<int, Attachment>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(Attachment $attachment): static
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments->add($attachment);
            $attachment->setExpenseId($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getExpenseId() === $this) {
                $attachment->setExpenseId(null);
            }
        }

        return $this;
    }
}
