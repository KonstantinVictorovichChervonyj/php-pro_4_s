<?php

namespace App\Services\Factories;

use App\Entity\UrlCodePairEntity;
use App\Entity\User;
use App\Repository\UrlCodePairRepository;
use App\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\SecurityBundle\Security;

class UrlCodePairFactory
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected Security $security
    )
    {
        $this->repository = $this->entityManager->getRepository(UrlCodePairEntity::class);
    }
    public function fromUrlCodePairVo(UrlCodePair $vo): UrlCodePairEntity
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();
        $entity = new UrlCodePairEntity($vo->getUrl(), $vo->getCode(), $user);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}