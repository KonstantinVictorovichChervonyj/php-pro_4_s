<?php

namespace App\Repository;

use App\Entity\UrlCodePairEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UrlCodePairEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlCodePairEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlCodePairEntity[] findAll()
 * @method UrlCodePairEntity[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlCodePairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlCodePairEntity::class);
    }
}
