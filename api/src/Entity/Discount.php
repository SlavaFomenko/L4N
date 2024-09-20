<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 *
 */
#[ORM\Entity(repositoryClass: DiscountRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['discount:get']]),
        new GetCollection(normalizationContext: ['groups' => ['discount:get']]),
        new Post(denormalizationContext: ['groups' => ['discount:post']]),
        new Put(denormalizationContext: ['groups' => ['discount:put']]),
        new Patch(denormalizationContext: ['groups' => ['discount:patch']]),
        new Delete()
    ]
)]
class Discount
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['discount:get'])]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    #[Groups(['discount:get',
              'discount:post',
              'discount:put',
              'discount:patch'])]
    private ?string $title = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    #[Groups(['discount:get',
              'discount:post',
              'discount:put',
              'discount:patch'])]
    private ?int $procent = null;

    /**
     * @var Collection<int, Receipt>
     */
    #[ORM\OneToMany(targetEntity: Receipt::class, mappedBy: 'discount')]
    #[Groups(['discount:get'])]
    private Collection $receipts;

    /**
     *
     */
    public function __construct()
    {
        $this->receipts = new ArrayCollection();
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
     * @return int|null
     */
    public function getProcent(): ?int
    {
        return $this->procent;
    }

    /**
     * @param int $procent
     * @return $this
     */
    public function setProcent(int $procent): self
    {
        $this->procent = $procent;

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
            $receipt->setDiscount($this);
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
            if ($receipt->getDiscount() === $this) {
                $receipt->setDiscount(null);
            }
        }

        return $this;
    }
}
