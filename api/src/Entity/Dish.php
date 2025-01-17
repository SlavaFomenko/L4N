<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
#[ORM\Entity(repositoryClass: DishRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:dish']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:dish']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:dish']]),
        new Put(denormalizationContext: ['groups' => ['put:item:dish']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:dish']]),
        new Delete()
    ],
)]
class Dish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:dish', 'get:collection:dish'])]
    private ?int $id = null;
    /**
     * @var Menu|null
     */
    #[ORM\ManyToOne(inversedBy: 'dishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?Menu $menu = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[NotBlank]
    #[Positive]
    #[Type("numeric")]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?string $price = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1)]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?string $description = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    #[NotBlank]
    #[Positive]
    #[Type("numeric")]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?string $weight = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank]
    #[Type('string')]
    #[Length(min: 1)]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?string $picture = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Type('bool')]
    #[Choice(choices: [true, false])]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?bool $isHidden = null;


    #[ORM\Column(length: 255)]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1, max: 255)]
    #[NotBlank]
    #[Groups([
        'get:item:dish',
        'get:collection:dish',
        'post:collection:dish',
        'put:item:dish',
        'patch:item:dish'
    ])]
    private ?string $title = null;


    /**
     * @var Collection<int, IngredientDish>
     */
    #[ORM\OneToMany(targetEntity: IngredientDish::class, mappedBy: 'dish')]
    #[Groups(['get:item:dish', 'get:collection:dish'])]
    private Collection $ingredientDishes;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'dish')]
    #[Groups(['get:item:dish', 'get:collection:dish'])]
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
    public function setMenu(?Menu $menu): self
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
    public function setPrice(string $price): self
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
    public function setDescription(string $description): self
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
    public function setWeight(string $weight): self
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
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    /**
     * @param bool $isHidden
     * @return $this
     */
    public function setIsHidden(bool $isHidden): self
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
    public function addIngredientDish(IngredientDish $ingredientDish): self
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
    public function removeIngredientDish(IngredientDish $ingredientDish): self
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
    public function addOrderDish(OrderDish $orderDish): self
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
    public function removeOrderDish(OrderDish $orderDish): self
    {
        if ($this->orderDishes->removeElement($orderDish)) {
            // set the owning side to null (unless already changed)
            if ($orderDish->getDish() === $this) {
                $orderDish->setDish(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}