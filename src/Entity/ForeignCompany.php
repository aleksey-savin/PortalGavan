<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForeignCompanyRepository")
 */
class ForeignCompany
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
     * @ORM\OneToMany(targetEntity="App\Entity\TouristGroup", mappedBy="foreignCompany")
     */
    private $touristGroups;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    public function __construct()
    {
        $this->touristGroups = new ArrayCollection();
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

    /**
     * @return Collection|TouristGroup[]
     */
    public function getTouristGroups(): Collection
    {
        return $this->touristGroups;
    }

    public function addTouristGroup(TouristGroup $touristGroup): self
    {
        if (!$this->touristGroups->contains($touristGroup)) {
            $this->touristGroups[] = $touristGroup;
            $touristGroup->setForeignCompany($this);
        }

        return $this;
    }

    public function removeTouristGroup(TouristGroup $touristGroup): self
    {
        if ($this->touristGroups->contains($touristGroup)) {
            $this->touristGroups->removeElement($touristGroup);
            // set the owning side to null (unless already changed)
            if ($touristGroup->getForeignCompany() === $this) {
                $touristGroup->setForeignCompany(null);
            }
        }

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
