<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 *
 */
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:order']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:order']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:order']]),
        new Put(denormalizationContext: ['groups' => ['put:item:order']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:order']]),
        new Delete()
    ],
)]
class Order
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:order', 'get:collection:order'])]
    private ?int $id = null;

    /**
     * @var StatusOrder|null
     */
    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:order',
        'get:collection:order',
        'post:collection:order',
        'put:item:order',
        'patch:item:order'
    ])]
    private ?StatusOrder $statusOrder = null;

    /**
     * @var Table|null
     */
    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:order',
        'get:collection:order',
        'post:collection:order',
        'put:item:order',
        'patch:item:order'
    ])]
    private ?Table $table = null;

    /**
     * @var Collection<int, Receipt>
     */
    #[ORM\OneToMany(targetEntity: Receipt::class, mappedBy: 'order')]
    #[Groups(['get:item:order', 'get:collection:order'])]
    private Collection $receipts;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'order')]
    #[Groups(['get:item:order', 'get:collection:order'])]
    private Collection $orderDishes;

    /**
     *
     */
    public function __construct()
    {
        $this->receipts = new ArrayCollection();
        $this->orderDishes = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return StatusOrder|null
     */
    public function getStatusOrder(): ?StatusOrder
    {
        return $this->statusOrder;
    }


    /**
     * @param StatusOrder|null $statusOrder
     * @return $this
     */
    public function setStatusOrder(?StatusOrder $statusOrder): self
    {
        $this->statusOrder = $statusOrder;

        return $this;
    }

    /**
     * @return Table|null
     */
    public function getTable(): ?Table
    {
        return $this->table;
    }

    /**
     * @param Table|null $table
     * @return $this
     */
    public function setTable(?Table $table): self
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @return Collection<int, Receipt>
     */
    public function getReceipts(): Collection
    {
        return $this->receipts;
    }

    /**
     * @param Receipt $receipt
     * @return $this
     */
    public function addReceipt(Receipt $receipt): self
    {
        if (!$this->receipts->contains($receipt)) {
            $this->receipts->add($receipt);
            $receipt->setOrder($this);
        }

        return $this;
    }

    /**
     * @param Receipt $receipt
     * @return $this
     */
    public function removeReceipt(Receipt $receipt): self
    {
        if ($this->receipts->removeElement($receipt)) {
            // set the owning side to null (unless already changed)
            if ($receipt->getOrder() === $this) {
                $receipt->setOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDish>
     */
    public function getOrderDishes(): Collection
    {
        return $this->orderDishes;
    }

    /**
     * @param OrderDish $orderDish
     * @return $this
     */
    public function addOrderDish(OrderDish $orderDish): self
    {
        if (!$this->orderDishes->contains($orderDish)) {
            $this->orderDishes->add($orderDish);
            $orderDish->setOrder($this);
        }

        return $this;
    }

    /**
     * @param OrderDish $orderDish
     * @return $this
     */
    public function removeOrderDish(OrderDish $orderDish): self
    {
        if ($this->orderDishes->removeElement($orderDish)) {
            // set the owning side to null (unless already changed)
            if ($orderDish->getOrder() === $this) {
                $orderDish->setOrder(null);
            }
        }

        return $this;
    }
}
