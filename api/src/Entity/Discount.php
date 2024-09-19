<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: DiscountRepository::class)]
class Discount
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var int|null
     */
    #[ORM\Column]
    private ?int $procent = null;

    /**
     * @var Collection<int, Receipt>
     */
    #[ORM\OneToMany(targetEntity: Receipt::class, mappedBy: 'discount')]
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
    public function setTitle(string $title): static
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
    public function setProcent(int $procent): static
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
    public function addReceipt(Receipt $receipt): static
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
    public function removeReceipt(Receipt $receipt): static
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
