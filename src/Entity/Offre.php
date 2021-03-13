<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as vich ;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 * @Vich\Uploadable
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3 , minMessage="Votre titre doit étre correcte > 3")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10 , minMessage="Une Description peut-pas etre inferieur a 3 char !")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreposte;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4 ,minMessage="Votre ville est-il inferieur a 3 char ??")
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $etude;

    /**
     * @ORM\Column(type="date")
     */
    private $delai;

    /**
     * @ORM\ManyToOne(targetEntity=Catcontrat::class, inversedBy="offres")
     */
    private $catcontrat;

    /**
     * @ORM\ManyToMany(targetEntity=Secteur::class, inversedBy="offres")
     */
    private $secteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity=Recruteur::class, inversedBy="offres")
     */
    private $recruteur;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $image;

    /**
     *@Vich\UploadableField(mapping="offre", fileNameProperty="image")
     *@var File|null
     */
    private $imageFile;

    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $updateAt;



    public function __construct()
    {
        $this->secteur = new ArrayCollection();
    }

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

    public function getNombreposte(): ?int
    {
        return $this->nombreposte;
    }

    public function setNombreposte(int $nombreposte): self
    {
        $this->nombreposte = $nombreposte;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }


    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEtude(): ?int
    {
        return $this->etude;
    }

    public function setEtude(int $etude): self
    {
        $this->etude = $etude;

        return $this;
    }

    public function getDelai(): ?\DateTimeInterface
    {
        return $this->delai;
    }

    public function setDelai(\DateTimeInterface $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getCatcontrat(): ?Catcontrat
    {
        return $this->catcontrat;
    }

    public function setCatcontrat(?Catcontrat $catcontrat): self
    {
        $this->catcontrat = $catcontrat;

        return $this;
    }

    /**
     * @return Collection|secteur[]
     */
    public function getSecteur(): Collection
    {
        return $this->secteur;
    }

    public function addSecteur(Secteur $secteur): self
    {
        if (!$this->secteur->contains($secteur)) {
            $this->secteur[] = $secteur;
        }

        return $this;
    }

    public function removeSecteur(Secteur $secteur): self
    {
        $this->secteur->removeElement($secteur);

        return $this;
    }
    public function __toString()
    {
        return $this->titre;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getRecruteur(): ?Recruteur
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteur $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
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

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
    
}
