<?php

namespace App\Service;

use App\Entity\Offer;
use App\Enum\JobStatus;
use App\Enum\OfferStatus;
use App\Service\JobUpdateService;
use Doctrine\ORM\EntityManagerInterface;

class OfferUpdateService
{
    private EntityManagerInterface $entityManager;
    private JobUpdateService $jobUpdateService;

    public function __construct(EntityManagerInterface $entityManager, JobUpdateService $jobUpdateService)
    {
        $this->entityManager = $entityManager;
        $this->jobUpdateService = $jobUpdateService;
    }

    public function updateStatus(Offer $offer, OfferStatus $status): Offer
    {
        $offer->setStatus($status);
        $this->entityManager->flush();

        if ($status === OfferStatus::ACCEPTED) {
            $this->jobUpdateService->updateStatus($offer->getJob(), JobStatus::IN_PROGRESS);
        }

        return $offer;
    }
}
