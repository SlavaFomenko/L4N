<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 *
 */
#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['ingredient:get']]),
        new GetCollection(normalizationContext: ['groups' => ['ingredient:get']]),
        new Post(denormalizationContext: ['groups' => ['ingredient:post']]),
        new Put(denormalizationContext: ['groups' => ['ingredient:put']]),
        new Patch(denormalizationContext: ['groups' => ['ingredient:patch']]),
        new Delete()
    ],
)]
class Ingredient
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ingredient:get'])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Groups(['ingredient:get',
              'ingredient:post',
              'ingredient:put',
              'ingredient:patch'])]
    private ?string $name = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['ingredient:get',
              'ingredient:post',
              'ingredient:put',
              'ingredient:patch'])]
    private ?string $picture = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['ingredient:get',
              'ingredient:post',
              'ingredient:put',
              'ingredient:patch'])]
    private ?bool $isAllergic = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    #[Groups(['ingredient:get',
              'ingredient:post',
              'ingredient:put',
              'ingredient:patch'])]
    private ?int $count = null;

    /**
     * @var Collection<int, IngredientDish>
     */
    #[ORM\OneToMany(targetEntity: IngredientDish::class, mappedBy: 'ingredient')]
    #[Groups(['ingredient:get'])]
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
    public function setName(string $name): self
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
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsAllergic(): ?bool
    {
        return $this->isAllergic;
    }

    /**
     * @param bool $isAllergic
     * @return $this
     */
    public function setIsAllergic(bool $isAllergic): self
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
    public function setCount(int $count): self
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
    public function addIngredientDish(IngredientDish $ingredientDish): self
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
    public function removeIngredientDish(IngredientDish $ingredientDish): self
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
