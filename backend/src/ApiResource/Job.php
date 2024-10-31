<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Enum\JobStatus;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put()
    ],
    normalizationContext: ['groups' => ['job:read']],
    denormalizationContext: ['groups' => ['job:write']]
)]
class Job
{
    #[Groups(['job:read'])]
    public ?int $id = null;

    #[Groups(['job:read', 'job:write'])]
    public string $title;

    #[Groups(['job:read', 'job:write'])]
    public string $description;

    #[Groups(['job:read'])]
    public \DateTimeInterface $createdAt;

    #[Groups(['job:read', 'job:write'])]
    public JobStatus $status = JobStatus::PENDING;
}
