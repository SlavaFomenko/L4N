<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
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
    private ?string $name = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    private ?string $picture = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    private ?bool $isAllergic = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    private ?int $count = null;

    /**
     * @var Collection<int, IngredientDish>
     */
    #[ORM\OneToMany(targetEntity: IngredientDish::class, mappedBy: 'ingredient')]
    private Collection $ingredientDishes;

    /**
     *
     */
    public function __construct()
    {
        $this->ingredientDishes = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;

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
    public function isAllergic(): ?bool
    {
        return $this->isAllergic;
    }

    /**
     * @param bool $isAllergic
     * @return $this
     */
    public function setIsAllergic(bool $isAllergic): static
    {
        $this->isAllergic = $isAllergic;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count): static
    {
        $this->count = $count;

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
            $ingredientDish->setIngredient($this);
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
            if ($ingredientDish->getIngredient() === $this) {
                $ingredientDish->setIngredient(null);
            }
        }

        return $this;
    }
}
