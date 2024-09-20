<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 *
 */
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['get:item:reservation']]),
        new GetCollection(normalizationContext: ['groups' => ['get:collection:reservation']]),
        new Post(denormalizationContext: ['groups' => ['post:collection:reservation']]),
        new Put(denormalizationContext: ['groups' => ['put:item:reservation']]),
        new Patch(denormalizationContext: ['groups' => ['patch:item:reservation']]),
        new Delete()
    ],
)]
class Reservation
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:item:reservation', 'get:collection:reservation'])]
    private ?int $id = null;

    /**
     * @var User|null
     */
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:reservation',
        'get:collection:reservation',
        'post:collection:reservation',
        'put:item:reservation',
        'patch:item:reservation'
    ])]
    private ?User $user = null;

    /**
     * @var Table|null
     */
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[NotBlank]
    #[Groups([
        'get:item:reservation',
        'get:collection:reservation',
        'post:collection:reservation',
        'put:item:reservation',
        'patch:item:reservation'
    ])]
    private ?Table $table = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[NotBlank]
    #[Groups([
        'get:item:reservation',
        'get:collection:reservation',
        'post:collection:reservation',
        'put:item:reservation',
        'patch:item:reservation'
    ])]
    private ?\DateTimeInterface $startTime = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Groups([
        'get:item:reservation',
        'get:collection:reservation',
        'post:collection:reservation',
        'put:item:reservation',
        'patch:item:reservation'
    ])]
    private ?\DateTimeInterface $endTime = null;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Table|null
     */
    public function getTable(): ?Table
    {
        return $this->table;
    }

    /**
     * @param Table|null $table
     * @return $this
     */
    public function setTable(?Table $table): self
    {
        $this->table = $table;

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
