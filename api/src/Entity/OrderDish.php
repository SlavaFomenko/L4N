<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\OrderDishRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;


/**
 *
 */
#[ORM\Entity(repositoryClass: OrderDishRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['orderDish:get']]),
        new GetCollection(normalizationContext: ['groups' => ['orderDish:get']]),
        new Post(denormalizationContext: ['groups' => ['orderDish:post']]),
        new Put(denormalizationContext: ['groups' => ['orderDish:put']]),
        new Patch(denormalizationContext: ['groups' => ['orderDish:patch']]),
        new Delete()
    ],
)]
class OrderDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['orderDish:get'])]
    private ?int $id = null;

    /**
     * @var Dish|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?Dish $dish = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?User $user = null;

    /**
     * @var StatusDish|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?StatusDish $statusDish = null;


    /**
     * @var Order|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?Order $order = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[NotBlank]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?\DateTimeInterface $startTime = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups(['orderDish:get',
              'orderDish:post',
              'orderDish:put',
              'orderDish:patch'])]
    private ?\DateTimeInterface $endTime = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return StatusDish|null
     */
    public function getStatusDish(): ?StatusDish
    {
        return $this->statusDish;
    }

    /**
     * @param StatusDish|null $statusDish
     * @return $this
     */
    public function setStatusDish(?StatusDish $statusDish): self
    {
        $this->statusDish = $statusDish;

        return $this;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     * @return $this
     */
    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    /**
     * @param \DateTimeInterface $startTime
     * @return $this
     */
    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    /**
     * @param \DateTimeInterface|null $endTime
     * @return $this
     */
    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }
}
