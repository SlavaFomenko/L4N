<?php

namespace App\Entity;

use App\Repository\IngredientDishRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: IngredientDishRepository::class)]
class IngredientDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Ingredient|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    /**
     * @var Dish|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dish $dish = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    private ?bool $compulsory_item = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Ingredient|null
     */
    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    /**
     * @param Ingredient|null $ingredient
     * @return $this
     */
    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * @return Dish|null
     */
    public function getDish(): ?Dish
    {
        return $this->dish;
    }

    /**
     * @param Dish|null $dish
     * @return $this
     */
    public function setDish(?Dish $dish): static
    {
        $this->dish = $dish;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isCompulsoryItem(): ?bool
    {
        return $this->compulsory_item;
    }

    /**
     * @param bool $compulsory_item
     * @return $this
     */
    public function setCompulsoryItem(bool $compulsory_item): static
    {
        $this->compulsory_item = $compulsory_item;

        return $this;
    }
}
