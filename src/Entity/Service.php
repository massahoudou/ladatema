<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @Vich\Uploadable
 */
class Service
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
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $image;

    /**
     *@Vich\UploadableField(mapping="service", fileNameProperty="image")
     *@var File|null
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="services")
     */
    private $admin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $afficher;

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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        //if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property

        //}
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

}
