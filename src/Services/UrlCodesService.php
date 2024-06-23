<?php

namespace App\Services;

use App\Entity\UrlCodePairEntity;
use App\Entity\User;
use App\Repository\UrlCodePairRepository;
use Doctrine\ORM\EntityManagerInterface;

class UrlCodesService
{
    protected UrlCodePairRepository $repository;
    public function __construct(
        EntityManagerInterface $em,
    )
    {
        $this->repository = $em->getRepository(UrlCodePairEntity::class);
    }

    public function getAllByUser(): array //(User $user): array
    {
        return $this->repository->findAll();
    }
}