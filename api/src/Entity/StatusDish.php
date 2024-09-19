<?php

namespace App\Entity;

use App\Repository\StatusDishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: StatusDishRepository::class)]
class StatusDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'status_dish')]
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
    public function setTitle(string $title): static
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
    public function setDescription(string $description): static
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
    public function addOrderDish(OrderDish $orderDish): static
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
    public function removeOrderDish(OrderDish $orderDish): static
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