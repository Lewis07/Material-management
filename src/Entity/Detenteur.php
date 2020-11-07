<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetenteurRepository")
 * @UniqueEntity("nomDetenteur",message="Ce detenteur existe déjà")
 */
class Detenteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $nomDetenteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fonction", inversedBy="detenteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetenirMateriel", mappedBy="detenteurs")
     */
    private $detenirMateriels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetenirMobilier", mappedBy="detenteurs")
     */
    private $detenirMobiliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Declaration", mappedBy="detenteurs")
     */
    private $declarations;

    public function __construct()
    {
        $this->detenirMateriels = new ArrayCollection();
        $this->detenirMobiliers = new ArrayCollection();
        $this->declarations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDetenteur(): ?string
    {
        return $this->nomDetenteur;
    }

    public function setNomDetenteur(string $nomDetenteur): self
    {
        $this->nomDetenteur = $nomDetenteur;

        return $this;
    }

    public function getContact(): ?int
    {
        return $this->contact;
    }

    public function setContact(int $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * @return Collection|DetenirMateriel[]
     */
    public function getDetenirMateriels(): Collection
    {
        return $this->detenirMateriels;
    }

    public function addDetenirMateriel(DetenirMateriel $detenirMateriel): self
    {
        if (!$this->detenirMateriels->contains($detenirMateriel)) {
            $this->detenirMateriels[] = $detenirMateriel;
            $detenirMateriel->setDetenteurs($this);
        }

        return $this;
    }

    public function removeDetenirMateriel(DetenirMateriel $detenirMateriel): self
    {
        if ($this->detenirMateriels->contains($detenirMateriel)) {
            $this->detenirMateriels->removeElement($detenirMateriel);
            // set the owning side to null (unless already changed)
            if ($detenirMateriel->getDetenteurs() === $this) {
                $detenirMateriel->setDetenteurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DetenirMobilier[]
     */
    public function getDetenirMobiliers(): Collection
    {
        return $this->detenirMobiliers;
    }

    public function addDetenirMobilier(DetenirMobilier $detenirMobilier): self
    {
        if (!$this->detenirMobiliers->contains($detenirMobilier)) {
            $this->detenirMobiliers[] = $detenirMobilier;
            $detenirMobilier->setDetenteurs($this);
        }

        return $this;
    }

    public function removeDetenirMobilier(DetenirMobilier $detenirMobilier): self
    {
        if ($this->detenirMobiliers->contains($detenirMobilier)) {
            $this->detenirMobiliers->removeElement($detenirMobilier);
            // set the owning side to null (unless already changed)
            if ($detenirMobilier->getDetenteurs() === $this) {
                $detenirMobilier->setDetenteurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Declaration[]
     */
    public function getDeclarations(): Collection
    {
        return $this->declarations;
    }

    public function addDeclaration(Declaration $declaration): self
    {
        if (!$this->declarations->contains($declaration)) {
            $this->declarations[] = $declaration;
            $declaration->setDetenteurs($this);
        }

        return $this;
    }

    public function removeDeclaration(Declaration $declaration): self
    {
        if ($this->declarations->contains($declaration)) {
            $this->declarations->removeElement($declaration);
            // set the owning side to null (unless already changed)
            if ($declaration->getDetenteurs() === $this) {
                $declaration->setDetenteurs(null);
            }
        }

        return $this;
    }
}
