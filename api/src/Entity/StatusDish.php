<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\StatusDishRepository;
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
#[ORM\Entity(repositoryClass: StatusDishRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:statusDish']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:statusDish']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:statusDish']]),
        new Put(denormalizationContext: ['groups' => ['put:item:statusDish']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:statusDish']]),
        new Delete()
    ],
)]
class StatusDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:statusDish', 'get:collection:statusDish'])]
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
        'get:item:statusDish',
        'get:collection:statusDish',
        'post:collection:statusDish',
        'put:item:statusDish',
        'patch:item:statusDish'
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
        'get:item:statusDish',
        'get:collection:statusDish',
        'post:collection:statusDish',
        'put:item:statusDish',
        'patch:item:statusDish'
    ])]
    private ?string $description = null;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'statusDish')]
    #[Groups(['get:item:statusDish', 'get:collection:statusDish'])]
    private Collection $orderDishes;

    /**
     *
     */
    public function __construct()
    {
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
            $orderDish->setStatusDish($this);
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
            if ($orderDish->getStatusDish() === $this) {
                $orderDish->setStatusDish(null);
            }
        }

        return $this;
    }
}
