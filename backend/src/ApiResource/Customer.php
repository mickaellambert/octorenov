<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [new Get()],
    normalizationContext: ['groups' => ['customer:read']]
)]
class Customer
{
    #[Groups(['customer:read'])]
    public ?int $id = null;

    #[Groups(['customer:read', 'job:read'])]
    public string $name;
}