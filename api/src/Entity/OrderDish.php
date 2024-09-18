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
    private ?StatusDish $status_dish = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start_time = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_time = null;

    /**
     * @var Order|null
     */
    #[ORM\ManyToOne(inversedBy: 'orderDishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;

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
        return $this->status_dish;
    }

    /**
     * @param StatusDish|null $status_dish
     * @return $this
     */
    public function setStatusDish(?StatusDish $status_dish): static
    {
        $this->status_dish = $status_dish;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    /**
     * @param \DateTimeInterface $start_time
     * @return $this
     */
    public function setStartTime(\DateTimeInterface $start_time): static
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->end_time;
    }

    /**
     * @param \DateTimeInterface|null $end_time
     * @return $this
     */
    public function setEndTime(?\DateTimeInterface $end_time): static
    {
        $this->end_time = $end_time;

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
}
