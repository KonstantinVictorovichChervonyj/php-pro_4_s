<?php

namespace App\Services;

use App\Entity\UrlCodePairEntity;
use App\Repository\UrlCodePairRepository;
use App\Services\Factories\UrlCodePairFactory;
use App\Shortener\Exceptions\DataNotFoundException;
use App\Shortener\Interfaces\ICodeRepository;
use App\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class ShortenerDoctrineRepository implements ICodeRepository
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected UrlCodePairFactory $factory
    )
    {
        $this->repository = $this->entityManager->getRepository(UrlCodePairEntity::class);
    }

    public function saveEntity(UrlCodePair $urlCodePair): bool
    {
        try {
            $this->factory->fromUrlCodePairVo($urlCodePair);
            $result = true;
        } catch (\Throwable) {
            $result = false;
        }
        return $result;
    }

    public function codeIsset(string $code): bool
    {
        return (bool)$this->repository->findOneBy(['code' => $code]);
    }

    public function getUrlByCode(string $code): string
    {
        return $this->getData(['code' => $code], 'Url is not found!')->getUrl();
    }

    public function getCodeByUrl(string $url): string
    {
        return $this->getData(['url' => $url], 'Code is not found!')->getCode();
    }

    protected function getData(array $criteria, string $exceptionMessage): UrlCodePairEntity
    {
        if (is_null($entity = $this->repository->findOneBy($criteria)))
        {
            throw new DataNotFoundException($exceptionMessage);
        }
        return $entity;
    }
}