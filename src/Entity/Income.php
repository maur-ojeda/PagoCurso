<?php

namespace App\Entity;

use App\Repository\IncomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncomeRepository::class)]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $incomeDate = null;

    #[ORM\Column(length: 255)]
    private ?string $incomeConcept = null;

    #[ORM\ManyToOne(inversedBy: 'incomes')]
    private ?SpecialEvent $specialEventId = null;

    #[ORM\OneToMany(mappedBy: 'incomeId', targetEntity: Attachment::class)]
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

    public function getIncomeDate(): ?\DateTimeInterface
    {
        return $this->incomeDate;
    }

    public function setIncomeDate(\DateTimeInterface $incomeDate): static
    {
        $this->incomeDate = $incomeDate;

        return $this;
    }

    public function getIncomeConcept(): ?string
    {
        return $this->incomeConcept;
    }

    public function setIncomeConcept(string $incomeConcept): static
    {
        $this->incomeConcept = $incomeConcept;

        return $this;
    }

    public function getSpecialEventId(): ?SpecialEvent
    {
        return $this->specialEventId;
    }

    public function setSpecialEventId(?SpecialEvent $specialEventId): static
    {
        $this->specialEventId = $specialEventId;

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
            $attachment->setIncomeId($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getIncomeId() === $this) {
                $attachment->setIncomeId(null);
            }
        }

        return $this;
    }
}
