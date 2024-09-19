<?php

namespace App\Entity;

use App\Repository\OrderDishRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: OrderDishRepository::class)]
class OrderDish
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Dish|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dish $dish = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var StatusDish|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatusDish $statusDish = null;


    /**
     * @var Order|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
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
    public function setDish(?Dish $dish): static
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
    public function setUser(?User $user): static
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
    public function setStatusDish(?StatusDish $statusDish): static
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
    public function setOrder(?Order $order): static
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
    public function setStartTime(\DateTimeInterface $startTime): static
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
    public function setEndTime(?\DateTimeInterface $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }
}
