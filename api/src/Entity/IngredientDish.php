<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IngredientDishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 *
 */
#[ORM\Entity(repositoryClass: IngredientDishRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['ingredientDish:read']],
    denormalizationContext: ['groups' => ['ingredientDish:write']]
)]
class IngredientDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ingredientDish:read'])]
    private ?int $id = null;

    /**
     * @var Ingredient|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ingredientDish:read', 'ingredientDish:write'])]
    private ?Ingredient $ingredient = null;

    /**
     * @var Dish|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['ingredientDish:read', 'ingredientDish:write'])]
    private ?Dish $dish = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['ingredientDish:read', 'ingredientDish:write'])]
    private ?bool $isCompulsoryItem = null;


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
    public function setIngredient(?Ingredient $ingredient): self
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
    public function setDish(?Dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCompulsoryItem(): ?bool
    {
        return $this->isCompulsoryItem;
    }

    /**
     * @param bool $isCompulsoryItem
     * @return $this
     */
    public function setIsCompulsoryItem(bool $isCompulsoryItem): self
    {
        $this->isCompulsoryItem = $isCompulsoryItem;

        return $this;
    }
}
