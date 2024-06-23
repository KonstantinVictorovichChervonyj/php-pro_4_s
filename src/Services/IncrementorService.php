<?php

namespace App\Services;

use App\Entity\Interfaces\IIncremental;
use App\Entity\UrlCodePairEntity;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class IncrementorService
{
    public function __construct(
        protected EntityManagerInterface $em
    ){}
    public function incrementAndSave(IIncremental $object): void
    {
        $object->increment();
        try {
            $this->em->persist($object);
            $this->em->flush();
        } catch (Throwable $exception) {
        }
    }
}