<?php

namespace App\Entity;

use App\Repository\AproposRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AproposRepository::class)
 */
class Apropos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $misajour;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="apropos")
     */
    private $admin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $afficher;

    /**
     * @ORM\Column(type="boolean" ,nullable=true)
     */
    private $Acceuil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMisajour(): ?\DateTimeInterface
    {
        return $this->misajour;
    }

    public function setMisajour(\DateTimeInterface $misajour): self
    {
        $this->misajour = $misajour;

        return $this;
    }

    public function getAdmin(): ?admin
    {
        return $this->admin;
    }

    public function setAdmin(?admin $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getAfficher(): ?bool
    {
        return $this->afficher;
    }

    public function setAfficher(?bool $afficher): self
    {
        $this->afficher = $afficher;

        return $this;
    }

    public function getAcceuil(): ?bool
    {
        return $this->Acceuil;
    }

    public function setAcceuil(bool $Acceuil): self
    {
        $this->Acceuil = $Acceuil;

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
}
