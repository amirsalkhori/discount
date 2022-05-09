<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\Order\OrderController;

#[ApiResource(collectionOperations: [
    'post'=> ["security" => "is_granted('ROLE_ADMIN')"],
    'get' => ["security" => "is_granted('ROLE_ADMIN')"],
    'order' => [
        'method' => 'POST',
        'path' => '/orders/wowcher',
        'controller' => OrderController::class,
        "security" => "is_granted('ROLE_USER')",
        'openapi_context'=>[
            'requestBody'=>[
                'content'=>[
                    'application/ld+json'=>[
                        'schema'=>[
                            'type'=> 'object',
                            'properties'=>[
                                'amount'=>[
                                    "type" => 'float'
                                ],
                                'code'=>[
                                    "type" => "string"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
],
    itemOperations: [
        'get'=> ["security_post_denormalize" => "is_granted('USER_READ', object)"],
        'delete'=> ["security" => "is_granted('ROLE_ADMIN')"],
        'put'=> ["security_post_denormalize" => "is_granted('USER_UPDATE', object)"]
    ],
    attributes: [
        'normalization_context' => ['groups' => ['user_read']],
        'denormalization_context' => ['groups' => ['user_write']],]
)
]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    private $owner;

    #[ORM\Column(type: 'float')]
    private $amount;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
