<?php

namespace App\Enum;

enum OfferStatus: int
{
    case PENDING = 1; // en attente
    case ACCEPTED = 2; // accepté
    case REJECTED = 3; // refusé
}