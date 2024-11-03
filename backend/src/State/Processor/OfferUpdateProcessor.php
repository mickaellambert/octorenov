<?php

namespace App\State\Processor;

use App\Entity\Offer;
use App\Enum\JobStatus;
use App\Enum\OfferStatus;
use ApiPlatform\Metadata\Operation;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OfferUpdateProcessor implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;
    private RequestStack $requestStack;
    private OfferRepository $offerRepository;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, OfferRepository $offerRepository)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->offerRepository = $offerRepository;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Offer
    {
        $offer = $uriVariables['id'] ? $this->offerRepository->find($uriVariables['id']) : null;

        if (!$offer instanceof Offer) {
            throw new \InvalidArgumentException('Expected instance of Offer.');
        }

        $request = $this->requestStack->getCurrentRequest();
        $status = (int) $request->toArray()['status'];

        if (OfferStatus::tryFrom($status) === null) {
            throw new BadRequestHttpException('Invalid status value.');
        }

        $offer->setStatus(OfferStatus::from($status));

        if ($status === OfferStatus::ACCEPTED) {
            $offer->getJob()->setStatus(JobStatus::IN_PROGRESS);
        }

        $this->entityManager->flush();

        return $offer;
    }
}
