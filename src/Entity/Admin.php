<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @UniqueEntity(fields={"email"}, message="Cet Email est deja utilisé")
 */
class Admin   extends Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Apropos::class, mappedBy="admin")
     */
    private $apropos;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="admin")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Gallery::class, mappedBy="admin")
     */
    private $galleries;

    public function __construct()
    {
        $this->apropos = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->galleries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


    /**
     * @return Collection|Apropos[]
     */
    public function getApropos(): Collection
    {
        return $this->apropos;
    }

    public function addApropo(Apropos $apropo): self
    {
        if (!$this->apropos->contains($apropo)) {
            $this->apropos[] = $apropo;
            $apropo->setAdmin($this);
        }

        return $this;
    }

    public function removeApropo(Apropos $apropo): self
    {
        if ($this->apropos->removeElement($apropo)) {
            // set the owning side to null (unless already changed)
            if ($apropo->getAdmin() === $this) {
                $apropo->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setAdmin($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getAdmin() === $this) {
                $service->setAdmin(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
       return  $this->getEmail();
    }

    /**
     * @return Collection|Gallery[]
     */
    public function getGalleries(): Collection
    {
        return $this->galleries;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries[] = $gallery;
            $gallery->setAdmin($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->galleries->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getAdmin() === $this) {
                $gallery->setAdmin(null);
            }
        }

        return $this;
    }


}
