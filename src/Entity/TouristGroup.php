<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TouristGroupRepository")
 */
class TouristGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfChildPersons;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfArrival;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfDeparture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUsers", inversedBy="touristGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appUser;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groupNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Purchase", mappedBy="touristGroup")
     */
    private $purchases;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $notifyGuide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForeignCompany", inversedBy="touristGroups")
     */
    private $foreignCompany;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $incomeServicesPaymentPerPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseMeeting;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseTransport;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseSeeingOff;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseTicketsPerPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseEcoDuesPerPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseBoatPerAdultPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseBread;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expenseTicketsNumberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expenseEcoDuesNumberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expenseBoatNumberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $incomeServicesPaymentNumberOfPersons;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseTicketsTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseEcoDuesTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseBoatTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $incomeServicesPaymentTotal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdditionalServices", mappedBy="touristGroup")
     */
    private $AdditionalServices;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expenseArMuseumNumberOfPersons;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseArMuseumTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseArMuseumPerPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseTuriyRogPerPerson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expenseTuriyRogNumberOfPersons;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $expenseTuriyRogTotal;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
        $this->AdditionalServices = new ArrayCollection();
    }



    public function getId()
    {
        return $this->id;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->numberOfPersons;
    }

    public function setNumberOfPersons(int $numberOfPersons): self
    {
        $this->numberOfPersons = $numberOfPersons;

        return $this;
    }

    public function getNumberOfChildPersons(): ?int
    {
        return $this->numberOfChildPersons;
    }

    public function setNumberOfChildPersons(int $numberOfChildPersons): self
    {
        $this->numberOfChildPersons = $numberOfChildPersons;

        return $this;
    }

    public function getDateOfArrival(): ?\DateTimeInterface
    {
        return $this->dateOfArrival;
    }

    public function setDateOfArrival(\DateTimeInterface $dateOfArrival): self
    {
        $this->dateOfArrival = $dateOfArrival;

        return $this;
    }

    public function getDateOfDeparture(): ?\DateTimeInterface
    {
        return $this->dateOfDeparture;
    }

    public function setDateOfDeparture(\DateTimeInterface $dateOfDeparture): self
    {
        $this->dateOfDeparture = $dateOfDeparture;

        return $this;
    }

    public function getAppUser(): ?AppUsers
    {
        return $this->appUser;
    }

    public function setAppUser(?AppUsers $appUser): self
    {
        $this->appUser = $appUser;

        return $this;
    }

    public function getGroupNumber(): ?string
    {
        return $this->groupNumber;
    }

    public function setGroupNumber(?string $groupNumber): self
    {
        $this->groupNumber = $groupNumber;

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
            $purchase->setTouristGroup($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getTouristGroup() === $this) {
                $purchase->setTouristGroup(null);
            }
        }

        return $this;
    }

    public function getNotifyGuide(): ?bool
    {
        return $this->notifyGuide;
    }

    public function setNotifyGuide(?bool $notifyGuide): self
    {
        $this->notifyGuide = $notifyGuide;

        return $this;
    }

    public function getForeignCompany(): ?ForeignCompany
    {
        return $this->foreignCompany;
    }

    public function setForeignCompany(?ForeignCompany $foreignCompany): self
    {
        $this->foreignCompany = $foreignCompany;

        return $this;
    }

    public function getIncomeServicesPaymentPerPerson(): ?float
    {
        return $this->incomeServicesPaymentPerPerson;
    }

    public function setIncomeServicesPaymentPerPerson(?float $incomeServicesPaymentPerPerson): self
    {
        $this->incomeServicesPaymentPerPerson = $incomeServicesPaymentPerPerson;

        return $this;
    }

    public function getExpenseMeeting(): ?float
    {
        return $this->expenseMeeting;
    }

    public function setExpenseMeeting(?float $expenseMeeting): self
    {
        $this->expenseMeeting = $expenseMeeting;

        return $this;
    }

    public function getExpenseTransport(): ?float
    {
        return $this->expenseTransport;
    }

    public function setExpenseTransport(?float $expenseTransport): self
    {
        $this->expenseTransport = $expenseTransport;

        return $this;
    }

    public function getExpenseSeeingOff(): ?float
    {
        return $this->expenseSeeingOff;
    }

    public function setExpenseSeeingOff(?float $expenseSeeingOff): self
    {
        $this->expenseSeeingOff = $expenseSeeingOff;

        return $this;
    }

    public function getExpenseTicketsPerPerson(): ?float
    {
        return $this->expenseTicketsPerPerson;
    }

    public function setExpenseTicketsPerPerson(?float $expenseTicketsPerPerson): self
    {
        $this->expenseTicketsPerPerson = $expenseTicketsPerPerson;

        return $this;
    }

    public function getExpenseEcoDuesPerPerson(): ?float
    {
        return $this->expenseEcoDuesPerPerson;
    }

    public function setExpenseEcoDuesPerPerson(?float $expenseEcoDuesPerPerson): self
    {
        $this->expenseEcoDuesPerPerson = $expenseEcoDuesPerPerson;

        return $this;
    }

    public function getExpenseBoatPerAdultPerson(): ?float
    {
        return $this->expenseBoatPerAdultPerson;
    }

    public function setExpenseBoatPerAdultPerson(?float $expenseBoatPerAdultPerson): self
    {
        $this->expenseBoatPerAdultPerson = $expenseBoatPerAdultPerson;

        return $this;
    }

    public function getExpenseBread(): ?float
    {
        return $this->expenseBread;
    }

    public function setExpenseBread(?float $expenseBread): self
    {
        $this->expenseBread = $expenseBread;

        return $this;
    }

    public function getExpenseTicketsNumberOfPersons(): ?int
    {
        return $this->expenseTicketsNumberOfPersons;
    }

    public function setExpenseTicketsNumberOfPersons(?int $expenseTicketsNumberOfPersons): self
    {
        $this->expenseTicketsNumberOfPersons = $expenseTicketsNumberOfPersons;

        return $this;
    }

    public function getExpenseEcoDuesNumberOfPersons(): ?int
    {
        return $this->expenseEcoDuesNumberOfPersons;
    }

    public function setExpenseEcoDuesNumberOfPersons(?int $expenseEcoDuesNumberOfPersons): self
    {
        $this->expenseEcoDuesNumberOfPersons = $expenseEcoDuesNumberOfPersons;

        return $this;
    }

    public function getExpenseBoatNumberOfPersons(): ?int
    {
        return $this->expenseBoatNumberOfPersons;
    }

    public function setExpenseBoatNumberOfPersons(?int $expenseBoatNumberOfPersons): self
    {
        $this->expenseBoatNumberOfPersons = $expenseBoatNumberOfPersons;

        return $this;
    }

    public function getIncomeServicesPaymentNumberOfPersons(): ?int
    {
        return $this->incomeServicesPaymentNumberOfPersons;
    }

    public function setIncomeServicesPaymentNumberOfPersons(?int $incomeServicesPaymentNumberOfPersons): self
    {
        $this->incomeServicesPaymentNumberOfPersons = $incomeServicesPaymentNumberOfPersons;

        return $this;
    }

    public function getExpenseTicketsTotal(): ?float
    {
        return $this->expenseTicketsTotal;
    }

    public function setExpenseTicketsTotal(?float $expenseTicketsTotal): self
    {
        $this->expenseTicketsTotal = $expenseTicketsTotal;

        return $this;
    }

    public function getExpenseEcoDuesTotal(): ?float
    {
        return $this->expenseEcoDuesTotal;
    }

    public function setExpenseEcoDuesTotal(?float $expenseEcoDuesTotal): self
    {
        $this->expenseEcoDuesTotal = $expenseEcoDuesTotal;

        return $this;
    }

    public function getExpenseBoatTotal(): ?float
    {
        return $this->expenseBoatTotal;
    }

    public function setExpenseBoatTotal(?float $expenseBoatTotal): self
    {
        $this->expenseBoatTotal = $expenseBoatTotal;

        return $this;
    }

    public function getIncomeServicesPaymentTotal(): ?float
    {
        return $this->incomeServicesPaymentTotal;
    }

    public function setIncomeServicesPaymentTotal(?float $incomeServicesPaymentTotal): self
    {
        $this->incomeServicesPaymentTotal = $incomeServicesPaymentTotal;

        return $this;
    }

    /**
     * @return Collection|AdditionalServices[]
     */
    public function getAdditionalServices(): Collection
    {
        return $this->AdditionalServices;
    }

    public function addAdditionalService(AdditionalServices $additionalService): self
    {
        if (!$this->AdditionalServices->contains($additionalService)) {
            $this->AdditionalServices[] = $additionalService;
            $additionalService->setTouristGroup($this);
        }

        return $this;
    }

    public function removeAdditionalService(AdditionalServices $additionalService): self
    {
        if ($this->AdditionalServices->contains($additionalService)) {
            $this->AdditionalServices->removeElement($additionalService);
            // set the owning side to null (unless already changed)
            if ($additionalService->getTouristGroup() === $this) {
                $additionalService->setTouristGroup(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExpenseArMuseumNumberOfPersons(): ?int
    {
        return $this->expenseArMuseumNumberOfPersons;
    }

    public function setExpenseArMuseumNumberOfPersons(?int $expenseArMuseumNumberOfPersons): self
    {
        $this->expenseArMuseumNumberOfPersons = $expenseArMuseumNumberOfPersons;

        return $this;
    }

    public function getExpenseArMuseumTotal(): ?float
    {
        return $this->expenseArMuseumTotal;
    }

    public function setExpenseArMuseumTotal(?float $expenseArMuseumTotal): self
    {
        $this->expenseArMuseumTotal = $expenseArMuseumTotal;

        return $this;
    }

    public function getExpenseArMuseumPerPerson(): ?float
    {
        return $this->expenseArMuseumPerPerson;
    }

    public function setExpenseArMuseumPerPerson(?float $expenseArMuseumPerPerson): self
    {
        $this->expenseArMuseumPerPerson = $expenseArMuseumPerPerson;

        return $this;
    }

    public function getExpenseTuriyRogPerPerson(): ?float
    {
        return $this->expenseTuriyRogPerPerson;
    }

    public function setExpenseTuriyRogPerPerson(?float $expenseTuriyRogPerPerson): self
    {
        $this->expenseTuriyRogPerPerson = $expenseTuriyRogPerPerson;

        return $this;
    }

    public function getExpenseTuriyRogNumberOfPersons(): ?int
    {
        return $this->expenseTuriyRogNumberOfPersons;
    }

    public function setExpenseTuriyRogNumberOfPersons(?int $expenseTuriyRogNumberOfPersons): self
    {
        $this->expenseTuriyRogNumberOfPersons = $expenseTuriyRogNumberOfPersons;

        return $this;
    }

    public function getExpenseTuriyRogTotal(): ?float
    {
        return $this->expenseTuriyRogTotal;
    }

    public function setExpenseTuriyRogTotal(?float $expenseTuriyRogTotal): self
    {
        $this->expenseTuriyRogTotal = $expenseTuriyRogTotal;

        return $this;
    }
}
