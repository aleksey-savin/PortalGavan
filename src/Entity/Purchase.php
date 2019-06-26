<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseRepository")
 */
class Purchase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TouristGroup", inversedBy="purchases")
     */
    private $touristGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TradePoint", inversedBy="purchases")
     */
    private $tradePoint;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commission", inversedBy="purchases")
     */
    private $commission;

    /**
     * @ORM\Column(type="float")
     */
    private $salesReceipt;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $groupLeaderCommissionValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $guideCommissionValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $companyCommissionValue;

    public function getId()
    {
        return $this->id;
    }

    public function getTouristGroup(): ?TouristGroup
    {
        return $this->touristGroup;
    }

    public function setTouristGroup(?TouristGroup $touristGroup): self
    {
        $this->touristGroup = $touristGroup;

        return $this;
    }

    public function getTradePoint(): ?TradePoint
    {
        return $this->tradePoint;
    }

    public function setTradePoint(?TradePoint $tradePoint): self
    {
        $this->tradePoint = $tradePoint;

        return $this;
    }

    public function getCommission(): ?Commission
    {
        return $this->commission;
    }

    public function setCommission(?Commission $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    public function getSalesReceipt(): ?float
    {
        return $this->salesReceipt;
    }

    public function setSalesReceipt(float $salesReceipt): self
    {
        $this->salesReceipt = $salesReceipt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGroupLeaderCommissionValue(): ?float
    {
        return $this->groupLeaderCommissionValue;
    }

    public function setGroupLeaderCommissionValue(?float $groupLeaderCommissionValue): self
    {
        $this->groupLeaderCommissionValue = $groupLeaderCommissionValue;

        return $this;
    }

    public function getGuideCommissionValue(): ?float
    {
        return $this->guideCommissionValue;
    }

    public function setGuideCommissionValue(?float $guideCommissionValue): self
    {
        $this->guideCommissionValue = $guideCommissionValue;

        return $this;
    }

    public function getCompanyCommissionValue(): ?float
    {
        return $this->companyCommissionValue;
    }

    public function setCompanyCommissionValue(?float $companyCommissionValue): self
    {
        $this->companyCommissionValue = $companyCommissionValue;

        return $this;
    }
}
