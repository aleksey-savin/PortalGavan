<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdditionalServicesRepository")
 */
class AdditionalServices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ServicesSupplier", inversedBy="additionalServices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ServicesSupplier;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPersons;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $guideCommissionValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $companyCommissionValue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TouristGroup", inversedBy="AdditionalServices")
     */
    private $touristGroup;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costPrice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $incomeValue;

    public function getId()
    {
        return $this->id;
    }

    public function getServicesSupplier(): ?ServicesSupplier
    {
        return $this->ServicesSupplier;
    }

    public function setServicesSupplier(?ServicesSupplier $ServicesSupplier): self
    {
        $this->ServicesSupplier = $ServicesSupplier;

        return $this;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->numberOfPersons;
    }

    public function setNumberOfPersons(?int $numberOfPersons): self
    {
        $this->numberOfPersons = $numberOfPersons;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
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

    public function getCostPrice(): ?float
    {
        return $this->costPrice;
    }

    public function setCostPrice(?float $costPrice): self
    {
        $this->costPrice = $costPrice;

        return $this;
    }

    public function getIncomeValue(): ?float
    {
        return $this->incomeValue;
    }

    public function setIncomeValue(?float $incomeValue): self
    {
        $this->incomeValue = $incomeValue;

        return $this;
    }
}
