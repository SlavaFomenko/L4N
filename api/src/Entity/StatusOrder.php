<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\StatusOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
#[ORM\Entity(repositoryClass: StatusOrderRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:statusOrder']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:statusOrder']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:statusOrder']]),
        new Put(denormalizationContext: ['groups' => ['put:item:statusOrder']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:statusOrder']]),
        new Delete()
    ],
)]
class StatusOrder
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:statusOrder', 'get:collection:statusOrder'])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1, max: 255)]
    #[NotBlank]
    #[Groups([
        'get:item:statusOrder',
        'get:collection:statusOrder',
        'post:collection:statusOrder',
        'put:item:statusOrder',
        'patch:item:statusOrder'
    ])]
    private ?string $title = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[NotBlank]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1)]
    #[Groups([
        'get:item:statusOrder',
        'get:collection:statusOrder',
        'post:collection:statusOrder',
        'put:item:statusOrder',
        'patch:item:statusOrder'
    ])]
    private ?string $description = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'statusOrder')]
    #[Groups(['get:item:statusOrder', 'get:collection:statusOrder'])]
    private Collection $orders;

    /**
     *
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setStatusOrder($this);
        }

        return $this;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStatusOrder() === $this) {
                $order->setStatusOrder(null);
            }
        }

        return $this;
    }
}
