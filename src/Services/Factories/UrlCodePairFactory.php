<?php

namespace App\Services\Factories;

use App\Entity\UrlCodePairEntity;
use App\Repository\UrlCodePairRepository;
use App\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class UrlCodePairFactory
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager
    )
    {
        $this->repository = $this->entityManager->getRepository(UrlCodePairEntity::class);
    }
    public function fromUrlCodePairVo(UrlCodePair $vo): UrlCodePairEntity
    {
        $entity = new UrlCodePairEntity($vo->getUrl(), $vo->getCode());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}