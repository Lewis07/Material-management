<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @UniqueEntity("libelleCateg",message="Ce categorie existe déjà")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $libelleCateg;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Materiel", mappedBy="categorieMateriel")
     */
    private $materiels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mobilier", mappedBy="categorieMobilier")
     */
    private $mobiliers;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $descriptionCateg;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->mobiliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCateg(): ?string
    {
        return $this->libelleCateg;
    }

    public function setLibelleCateg(string $libelleCateg): self
    {
        $this->libelleCateg = $libelleCateg;

        return $this;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setCategorieMateriel($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->contains($materiel)) {
            $this->materiels->removeElement($materiel);
            // set the owning side to null (unless already changed)
            if ($materiel->getCategorieMateriel() === $this) {
                $materiel->setCategorieMateriel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mobilier[]
     */
    public function getMobiliers(): Collection
    {
        return $this->mobiliers;
    }

    public function addMobilier(Mobilier $mobilier): self
    {
        if (!$this->mobiliers->contains($mobilier)) {
            $this->mobiliers[] = $mobilier;
            $mobilier->setCategorieMobilier($this);
        }

        return $this;
    }

    public function removeMobilier(Mobilier $mobilier): self
    {
        if ($this->mobiliers->contains($mobilier)) {
            $this->mobiliers->removeElement($mobilier);
            // set the owning side to null (unless already changed)
            if ($mobilier->getCategorieMobilier() === $this) {
                $mobilier->setCategorieMobilier(null);
            }
        }

        return $this;
    }

    public function getDescriptionCateg(): ?string
    {
        return $this->descriptionCateg;
    }

    public function setDescriptionCateg(string $descriptionCateg): self
    {
        $this->descriptionCateg = $descriptionCateg;

        return $this;
    }
}
