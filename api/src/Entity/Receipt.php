<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ReceiptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
#[ORM\Entity(repositoryClass: ReceiptRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:receipt']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:receipt']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:receipt']]),
        new Put(denormalizationContext: ['groups' => ['put:item:receipt']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:receipt']]),
        new Delete()
    ],
)]
class Receipt
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:receipt', 'get:collection:receipt'])]
    private ?int $id = null;

    /**
     * @var Order|null
     */
    #[ORM\ManyToOne(inversedBy: 'receipts')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:receipt',
        'get:collection:receipt',
        'post:collection:receipt',
        'put:item:receipt',
        'patch:item:receipt'
    ])]
    private ?Order $order = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'receipts')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:receipt',
        'get:collection:receipt',
        'post:collection:receipt',
        'put:item:receipt',
        'patch:item:receipt'
    ])]
    private ?User $user = null;

    /**
     * @var Discount|null
     */
    #[ORM\ManyToOne(inversedBy: 'receipts')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:receipt',
        'get:collection:receipt',
        'post:collection:receipt',
        'put:item:receipt',
        'patch:item:receipt'
    ])]
    private ?Discount $discount = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[NotBlank]
    #[Positive]
    #[Type("numeric")]
    #[Groups([
        'get:item:receipt',
        'get:collection:receipt',
        'post:collection:receipt',
        'put:item:receipt',
        'patch:item:receipt'
    ])]
    private ?string $price = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     * @return $this
     */
    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Discount|null
     */
    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    /**
     * @param Discount|null $discount
     * @return $this
     */
    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
