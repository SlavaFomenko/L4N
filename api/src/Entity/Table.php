<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 *
 */
#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['table:get']]),
        new GetCollection(normalizationContext: ['groups' => ['table:get']]),
        new Post(denormalizationContext: ['groups' => ['table:post']]),
        new Put(denormalizationContext: ['groups' => ['table:put']]),
        new Patch(denormalizationContext: ['groups' => ['table:patch']]),
        new Delete()
    ],
)]
class Table
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['table:get'])]
    private ?int $id = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    #[Groups(['table:get',
              'table:post',
              'table:put',
              'table:patch'])]
    private ?int $number = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    #[Groups(['table:get',
              'table:post',
              'table:put',
              'table:patch'])]
    private ?int $countSeatPlace = null;

    /**
     * @var bool|null
     */
    #[ORM\Column]
    #[Groups(['table:get',
              'table:post',
              'table:put',
              'table:patch'])]
    private ?bool $isTake = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'table')]
    #[Groups(['table:get'])]
    private Collection $orders;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'table')]
    #[Groups(['table:get'])]
    private Collection $reservations;


    /**
     *
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setTable($this);
        }

        return $this;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getTable() === $this) {
                $order->setTable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    /**
     * @param Reservation $reservation
     * @return $this
     */
    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setTable($this);
        }

        return $this;
    }

    /**
     * @param Reservation $reservation
     * @return $this
     */
    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTable() === $this) {
                $reservation->setTable(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountSeatPlace(): ?string
    {
        return $this->countSeatPlace;
    }

    /**
     * @param string $countSeatPlace
     * @return $this
     */
    public function setCountSeatPlace(string $countSeatPlace): self
    {
        $this->countSeatPlace = $countSeatPlace;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsTake(): ?bool
    {
        return $this->isTake;
    }

    /**
     * @param bool $isTake
     * @return $this
     */
    public function setIsTake(bool $isTake): self
    {
        $this->isTake = $isTake;

        return $this;
    }
}
