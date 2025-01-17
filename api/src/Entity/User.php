<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\State\UserPasswordHasherState;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:user']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:user']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:user']],processor: UserPasswordHasherState::class),
        new Put(denormalizationContext: ['groups' => ['put:item:user']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:user']]),
        new Delete()
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_WAITER = 'ROLE_WAITER';
    const ROLE_COOK = 'ROLE_COOK';
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:user', 'get:collection:user'])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:item:user',
              'get:collection:user',
              'post:collection:user',
              'put:item:user',
              'patch:item:user'])]
    private ?string $email = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Type('string')]
    #[Regex('/[A-Za-zА-Яа-я0-9іІЇїЄєЪъЭэёЁ\s]/')]
    #[Length(min: 1, max: 255)]
    #[NotBlank]
    #[Groups(['get:item:user',
              'get:collection:user',
              'post:collection:user',
              'put:item:user',
              'patch:item:user'])]
    private ?string $username = null;

    /**
     * @var array|null
     */
    #[ORM\Column(type: Types::ARRAY)]
    #[NotBlank]
    #[Groups(['get:item:user',
        'get:collection:user',
        'post:collection:user',
        'put:item:user',
        'patch:item:user'])]
    private ?array $roles = [User::ROLE_USER];

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Type('string')]
    #[NotBlank]
    #[Regex("/(?=.*\+[0-9]{3}\s?[0-9]{2}\s?[0-9]{3}\s?[0-9]{4,5}$)/")]
    #[Groups(['get:item:user',
              'get:collection:user',
              'post:collection:user',
              'put:item:user',
              'patch:item:user'])]
    private ?string $phone = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['get:item:user',
              'get:collection:user',
              'post:collection:user',
              'put:item:user',
              'patch:item:user'])]
    private ?string $password = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'user')]
    #[Groups(['get:item:user', 'get:collection:user'])]
    private Collection $reservations;

    /**
     * @var Collection<int, Receipt>
     */
    #[ORM\OneToMany(targetEntity: Receipt::class, mappedBy: 'user')]
    #[Groups(['get:item:user', 'get:collection:user'])]
    private Collection $receipts;

    /**
     * @var Collection<int, OrderDish>
     */
    #[ORM\OneToMany(targetEntity: OrderDish::class, mappedBy: 'user')]
    #[Groups(['get:item:user', 'get:collection:user'])]
    private Collection $orderDishes;

    /**
     *
     */
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->receipts = new ArrayCollection();
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
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRole(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return $this
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

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
            $reservation->setUser($this);
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
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Receipt>
     */
    public function getReceipts(): Collection
    {
        return $this->receipts;
    }

    /**
     * @param Receipt $receipt
     * @return $this
     */
    public function addReceipt(Receipt $receipt): self
    {
        if (!$this->receipts->contains($receipt)) {
            $this->receipts->add($receipt);
            $receipt->setUser($this);
        }

        return $this;
    }

    /**
     * @param Receipt $receipt
     * @return $this
     */
    public function removeReceipt(Receipt $receipt): self
    {
        if ($this->receipts->removeElement($receipt)) {
            // set the owning side to null (unless already changed)
            if ($receipt->getUser() === $this) {
                $receipt->setUser(null);
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
            $orderDish->setUser($this);
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
            if ($orderDish->getUser() === $this) {
                $orderDish->setUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials(): void
    {}

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
