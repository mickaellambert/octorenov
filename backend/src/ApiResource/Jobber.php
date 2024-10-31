<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [new Get()],
    normalizationContext: ['groups' => ['jobber:read']]
)]
class Jobber
{
    #[Groups(['jobber:read'])]
    public ?int $id = null;

    #[Groups(['jobber:read'])]
    public string $name;
}