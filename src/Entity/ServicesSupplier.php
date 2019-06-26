<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicesSupplierRepository")
 */
class ServicesSupplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costPerPerson;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdditionalServices", mappedBy="ServicesSupplier", orphanRemoval=true)
     */
    private $additionalServices;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costForClient;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $guideCommissionPct;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    public function __construct()
    {
        $this->additionalServices = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getCostPerPerson(): ?float
    {
        return $this->costPerPerson;
    }

    public function setCostPerPerson(?float $costPerPerson): self
    {
        $this->costPerPerson = $costPerPerson;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(?string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactNumber(): ?string
    {
        return $this->contactNumber;
    }

    public function setContactNumber(?string $contactNumber): self
    {
        $this->contactNumber = $contactNumber;

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

    /**
     * @return Collection|AdditionalServices[]
     */
    public function getAdditionalServices(): Collection
    {
        return $this->additionalServices;
    }

    public function addAdditionalService(AdditionalServices $additionalService): self
    {
        if (!$this->additionalServices->contains($additionalService)) {
            $this->additionalServices[] = $additionalService;
            $additionalService->setServicesSupplier($this);
        }

        return $this;
    }

    public function removeAdditionalService(AdditionalServices $additionalService): self
    {
        if ($this->additionalServices->contains($additionalService)) {
            $this->additionalServices->removeElement($additionalService);
            // set the owning side to null (unless already changed)
            if ($additionalService->getServicesSupplier() === $this) {
                $additionalService->setServicesSupplier(null);
            }
        }

        return $this;
    }

    public function getCostForClient(): ?float
    {
        return $this->costForClient;
    }

    public function setCostForClient(?float $costForClient): self
    {
        $this->costForClient = $costForClient;

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
