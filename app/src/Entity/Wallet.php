<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Bridge\CreatedAt;
use App\Bridge\UpdatedAt;
use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(collectionOperations: [
    'get' => ["security" => "is_granted('ROLE_ADMIN')"],
    'post' => ["security" => "is_granted('ROLE_ADMIN')"],
],
    itemOperations: [
        'get' => ["security_post_denormalize" => "is_granted('WALLET_READ', object)"],
        'delete' => ["security" => "is_granted('ROLE_ADMIN')"],
        'put' => ["security" => "is_granted('ROLE_ADMIN')"],
    ],
    attributes: [
        'normalization_context' => ['groups' => ['wallet_read']],
        'denormalization_context' => ['groups' => ['wallet_write']],]
)
]
#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet implements CreatedAt, UpdatedAt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["wallet_read"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["wallet_read", "wallet_write"])]
    private $amount;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(["wallet_read"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(["wallet_read"])]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'wallets')]
    #[Groups(["wallet_read", "wallet_write"])]
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;

    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;

    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
