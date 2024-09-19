<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: DishRepository::class)]
class Dish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Menu|null
     */
    #[ORM\ManyToOne(inversedBy: 'dishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $weight = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $picture = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    private ?bool $isHidden = null;

    /**
     * @var Collection<int, IngredientDish>
     */
    #[ORM\OneToMany(targetEntity: IngredientDish::class, mappedBy: 'dish')]
    private Collection $ingredientDishes;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'dish')]
    private Collection $orderDishes;

    /**
     *
     */
    public function __construct()
    {
        $this->ingredientDishes = new ArrayCollection();
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
     * @return Menu|null
     */
    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    /**
     * @param Menu|null $menu
     * @return $this
     */
    public function setMenu(?Menu $menu): static
    {
        $this->menu = $menu;

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
    public function setPrice(string $price): static
    {
        $this->price = $price;

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
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     * @return $this
     */
    public function setWeight(string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return $this
     */
    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool $isHidden
     * @return $this
     */
    public function setIsHidden(bool $isHidden): static
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * @return Collection<int, IngredientDish>
     */
    public function getIngredientDishes(): Collection
    {
        return $this->ingredientDishes;
    }

    /**
     * @param IngredientDish $ingredientDish
     * @return $this
     */
    public function addIngredientDish(IngredientDish $ingredientDish): static
    {
        if (!$this->ingredientDishes->contains($ingredientDish)) {
            $this->ingredientDishes->add($ingredientDish);
            $ingredientDish->setDish($this);
        }

        return $this;
    }

    /**
     * @param IngredientDish $ingredientDish
     * @return $this
     */
    public function removeIngredientDish(IngredientDish $ingredientDish): static
    {
        if ($this->ingredientDishes->removeElement($ingredientDish)) {
            // set the owning side to null (unless already changed)
            if ($ingredientDish->getDish() === $this) {
                $ingredientDish->setDish(null);
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
    public function addOrderDish(OrderDish $orderDish): static
    {
        if (!$this->orderDishes->contains($orderDish)) {
            $this->orderDishes->add($orderDish);
            $orderDish->setDish($this);
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
            if ($orderDish->getDish() === $this) {
                $orderDish->setDish(null);
            }
        }

        return $this;
    }
}