<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\MenuRepository;
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
#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:menu']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:menu']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:menu']]),
        new Put(denormalizationContext: ['groups' => ['put:item:menu']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:menu']]),
        new Delete()
    ],
)]
class Menu
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:menu', 'get:collection:menu'])]
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
        'get:item:menu',
        'get:collection:menu',
        'post:collection:menu',
        'put:item:menu',
        'patch:item:menu'
    ])]
    private ?string $title = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1, max: 255)]
    #[NotBlank]
    #[Groups([
        'get:item:menu',
        'get:collection:menu',
        'post:collection:menu',
        'put:item:menu',
        'patch:item:menu'
    ])]
    private ?string $type = null;

    /**
     * @var Collection<int, Dish>
     */
    #[ORM\OneToMany(targetEntity: Dish::class, mappedBy: 'menu')]
    #[Groups(['get:item:menu', 'get:collection:menu'])]
    private Collection $dishes;

    /**
     *
     */
    public function __construct()
    {
        $this->dishes = new ArrayCollection();
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Dish>
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    /**
     * @param Dish $dish
     * @return $this
     */
    public function addDish(Dish $dish): self
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes->add($dish);
            $dish->setMenu($this);
        }

        return $this;
    }

    /**
     * @param Dish $dish
     * @return $this
     */
    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->removeElement($dish)) {
            // set the owning side to null (unless already changed)
            if ($dish->getMenu() === $this) {
                $dish->setMenu(null);
            }
        }

        return $this;
    }
}
