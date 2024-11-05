<?php

namespace App\State\Processor;

use App\Entity\Offer;
use App\Enum\JobStatus;
use App\Enum\OfferStatus;
use ApiPlatform\Metadata\Operation;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use App\Service\OfferUpdateService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OfferUpdateProcessor implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;
    private RequestStack $requestStack;
    private OfferRepository $offerRepository;
    private OfferUpdateService $offerUpdateService;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, OfferRepository $offerRepository, OfferUpdateService $offerUpdateService)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->offerRepository = $offerRepository;
        $this->offerUpdateService = $offerUpdateService;
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

        return $this->offerUpdateService->updateStatus($offer, OfferStatus::from($status));
    }
}
