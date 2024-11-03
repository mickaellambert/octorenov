<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Enum\OfferStatus;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OfferRepository;
use ApiPlatform\Metadata\ApiResource;
use App\State\Processor\OfferUpdateProcessor;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(
            description: 'Retrieve detailed information about a specific offer.'
        ),
        new Post(
            description: 'Submit a new offer for a job.'
        ),
        new Put(
            description: 'Update the offer, including its status.',
            processor: OfferUpdateProcessor::class
        ),
    ],
    normalizationContext: ['groups' => ['offer:read']],
    denormalizationContext: ['groups' => ['offer:write']]
)]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['offer:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['offer:read', 'offer:write'])]
    private ?float $amount = null;

    #[ORM\Column(type: 'integer', enumType: OfferStatus::class)]
    #[Groups(['offer:read', 'offer:write'])]
    private OfferStatus $status = OfferStatus::PENDING;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['offer:read'])]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Groups(['offer:read'])]
    private ?DateTimeImmutable $updatedAt = null;
    
    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['offer:read', 'offer:write'])]
    private ?Job $job = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['offer:read', 'offer:write'])]
    private ?Jobber $jobber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): OfferStatus
    {
        return $this->status;
    }

    public function setStatus(OfferStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
    
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getJobber(): ?Jobber
    {
        return $this->jobber;
    }

    public function setJobber(?Jobber $jobber): static
    {
        $this->jobber = $jobber;

        return $this;
    }
}
