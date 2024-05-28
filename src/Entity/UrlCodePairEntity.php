<?php

namespace App\Entity;

use App\Repository\UrlCodePairRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlCodePairRepository::class)]
#[ORM\Table(name: 'url_code_pair')]
class UrlCodePairEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $count = 0;

    public function __construct(
        #[ORM\Column(length: 255)]
        private ?string $url,
        #[ORM\Column(length: 10)]
        private ?string $code
    )
    {

    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function incrementCount(): static
    {
        $this->count++;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

}
