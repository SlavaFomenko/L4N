<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\IngredientDishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
#[ORM\Entity(repositoryClass: IngredientDishRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:ingredientDish']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:ingredientDish']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:ingredientDish']]),
        new Put(denormalizationContext: ['groups' => ['put:item:ingredientDish']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:ingredientDish']]),
        new Delete()
    ],
)]
class IngredientDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:ingredientDish', 'get:collection:ingredientDish'])]
    private ?int $id = null;

    /**
     * @var Ingredient|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:ingredientDish',
        'get:collection:ingredientDish',
        'post:collection:ingredientDish',
        'put:item:ingredientDish',
        'patch:item:ingredientDish'
    ])]
    private ?Ingredient $ingredient = null;

    /**
     * @var Dish|null
     */
    #[ORM\ManyToOne(inversedBy: 'ingredientDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:ingredientDish',
        'get:collection:ingredientDish',
        'post:collection:ingredientDish',
        'put:item:ingredientDish',
        'patch:item:ingredientDish'
    ])]
    private ?Dish $dish = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Type('bool')]
    #[Choice(choices: [true, false])]
    #[Groups([
        'get:item:ingredientDish',
        'get:collection:ingredientDish',
        'post:collection:ingredientDish',
        'put:item:ingredientDish',
        'patch:item:ingredientDish'
    ])]
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
