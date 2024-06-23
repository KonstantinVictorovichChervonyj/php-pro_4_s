<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_VIP = 2;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\Column]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Phone::class, fetch: 'LAZY')]
    #[Groups(['full'])]
    private Collection $phones;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = 0;

    #[ORM\Column(length: 60, unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(length: 32, unique: true, nullable: false)]
    private string $apiToken;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->generateApiToken();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function isActiveUser(): bool
    {
        return $this->status === static::STATUS_ACTIVE;
    }

    public function isDisabledUser(): bool
    {
        return $this->status === static::STATUS_DISABLED;
    }

    public function isVIPUser(): bool
    {
        return $this->status === static::STATUS_VIP;
    }

    public function setStatusDisabled(): void
    {
        $this->status = static::STATUS_DISABLED;
    }

    public function setStatusActive(): void
    {
        $this->status = static::STATUS_ACTIVE;
    }

    public function setStatusVIP(): void
    {
        $this->status = static::STATUS_VIP;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function generateApiToken(): static
    {
        $this->apiToken = md5(rand() . (new DateTime())->getTimestamp());

        return $this;
    }
}
