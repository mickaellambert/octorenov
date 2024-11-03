<?php

namespace App\Service;

use App\Entity\Job;
use App\Enum\JobStatus;
use Doctrine\ORM\EntityManagerInterface;

class JobUpdateService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateStatus(Job $job, JobStatus $status): void
    {
        $job->setStatus($status);
        $this->entityManager->flush();
    }
}