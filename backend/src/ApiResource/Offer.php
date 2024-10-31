<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Enum\OfferStatus;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put()
    ],
    normalizationContext: ['groups' => ['offer:read']],
    denormalizationContext: ['groups' => ['offer:write']]
)]
class Offer
{
    #[Groups(['offer:read'])]
    public ?int $id = null;

    #[Groups(['offer:read', 'offer:write'])]
    public float $amount;

    #[Groups(['offer:read', 'offer:write'])]
    public OfferStatus $status = OfferStatus::PENDING;
}