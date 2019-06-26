<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommissionRepository")
 */
class Commission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TradePoint", inversedBy="commissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tradePointId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $totalCommissionPct;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fTotalCommissionPct;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $groupLeaderCommissionPct;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $guideCommissionPct;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $companyCommissionPct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Purchase", mappedBy="commission")
     */
    private $purchases;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTradePointId(): ?TradePoint
    {
        return $this->tradePointId;
    }

    public function setTradePointId(?TradePoint $tradePointId): self
    {
        $this->tradePointId = $tradePointId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTotalCommissionPct(): ?float
    {
        return $this->totalCommissionPct;
    }

    public function setTotalCommissionPct(float $totalCommissionPct): self
    {
        $this->totalCommissionPct = $totalCommissionPct;

        return $this;
    }

    public function getFTotalCommissionPct(): ?float
    {
        return $this->fTotalCommissionPct;
    }

    public function setFTotalCommissionPct(?float $fTotalCommissionPct): self
    {
        $this->fTotalCommissionPct = $fTotalCommissionPct;

        return $this;
    }

    public function getGroupLeaderCommissionPct(): ?float
    {
        return $this->groupLeaderCommissionPct;
    }

    public function setGroupLeaderCommissionPct(?float $groupLeaderCommissionPct): self
    {
        $this->groupLeaderCommissionPct = $groupLeaderCommissionPct;

        return $this;
    }

    public function getGuideCommissionPct(): ?float
    {
        return $this->guideCommissionPct;
    }

    public function setGuideCommissionPct(?float $guideCommissionPct): self
    {
        $this->guideCommissionPct = $guideCommissionPct;

        return $this;
    }

    public function getCompanyCommissionPct(): ?float
    {
        return $this->companyCommissionPct;
    }

    public function setCompanyCommissionPct(?float $companyCommissionPct): self
    {
        $this->companyCommissionPct = $companyCommissionPct;

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setCommission($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getCommission() === $this) {
                $purchase->setCommission(null);
            }
        }

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
