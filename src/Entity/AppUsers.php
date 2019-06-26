<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\AppUsersRepository")
 */
class AppUsers implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="boolean", unique=false)
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TouristGroup", mappedBy="appUser")
     */
    private $touristGroups;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $realName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PLOTNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;


    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function __construct()
    {
        $this->isActive = true;
        $this->touristGroups = new ArrayCollection();
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        if ($this->getRole() === 'ROLE_ADMIN'){
            return array('ROLE_ADMIN');
        }

        if ($this->getRole() === 'ROLE_GUIDE'){
            return array('ROLE_GUIDE');
        }
        //ДА, ЭТО ПОЛНЫЙ ПИЗДЕЦ. НЕ ГРАМОТНЫЙ, НО СМЕКАЛИСТЫЙ, ХУЛИ))
    }


    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,

            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,

            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
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
            $touristGroup->setAppUser($this);
        }

        return $this;
    }

    public function removeTouristGroup(TouristGroup $touristGroup): self
    {
        if ($this->touristGroups->contains($touristGroup)) {
            $this->touristGroups->removeElement($touristGroup);
            // set the owning side to null (unless already changed)
            if ($touristGroup->getAppUser() === $this) {
                $touristGroup->setAppUser(null);
            }
        }

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(?string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPLOTNumber(): ?string
    {
        return $this->PLOTNumber;
    }

    public function setPLOTNumber(?string $PLOTNumber): self
    {
        $this->PLOTNumber = $PLOTNumber;

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
