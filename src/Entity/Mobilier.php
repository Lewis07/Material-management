<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobilierRepository")
 * @UniqueEntity("codeMobilier",message="Ce mobilier existe déjà")
 */
class Mobilier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $codeMobilier;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="mobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieMobilier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournirMobilier", mappedBy="mobiliers")
     */
    private $fournirMobiliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetenirMobilier", mappedBy="mobiliers")
     */
    private $detenirMobiliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entretien", mappedBy="mobiliers",cascade={"remove"})
     */
    private $entretiens;

    /**
     * @ORM\Column(type="boolean")
     */
    private $service;

    public function __construct()
    {
        $this->fournirMobiliers = new ArrayCollection();
        $this->detenirMobiliers = new ArrayCollection();
        $this->entretiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeMobilier(): ?string
    {
        return $this->codeMobilier;
    }

    public function setCodeMobilier(string $codeMobilier): self
    {
        $this->codeMobilier = $codeMobilier;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCategorieMobilier(): ?Categorie
    {
        return $this->categorieMobilier;
    }

    public function setCategorieMobilier(?Categorie $categorieMobilier): self
    {
        $this->categorieMobilier = $categorieMobilier;

        return $this;
    }

    /**
     * @return Collection|FournirMobilier[]
     */
    public function getFournirMobiliers(): Collection
    {
        return $this->fournirMobiliers;
    }

    public function addFournirMobilier(FournirMobilier $fournirMobilier): self
    {
        if (!$this->fournirMobiliers->contains($fournirMobilier)) {
            $this->fournirMobiliers[] = $fournirMobilier;
            $fournirMobilier->setMobiliers($this);
        }

        return $this;
    }

    public function removeFournirMobilier(FournirMobilier $fournirMobilier): self
    {
        if ($this->fournirMobiliers->contains($fournirMobilier)) {
            $this->fournirMobiliers->removeElement($fournirMobilier);
            // set the owning side to null (unless already changed)
            if ($fournirMobilier->getMobiliers() === $this) {
                $fournirMobilier->setMobiliers(null);
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
            $detenirMobilier->setMobiliers($this);
        }

        return $this;
    }

    public function removeDetenirMobilier(DetenirMobilier $detenirMobilier): self
    {
        if ($this->detenirMobiliers->contains($detenirMobilier)) {
            $this->detenirMobiliers->removeElement($detenirMobilier);
            // set the owning side to null (unless already changed)
            if ($detenirMobilier->getMobiliers() === $this) {
                $detenirMobilier->setMobiliers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entretien[]
     */
    public function getEntretiens(): Collection
    {
        return $this->entretiens;
    }

    public function addEntretien(Entretien $entretien): self
    {
        if (!$this->entretiens->contains($entretien)) {
            $this->entretiens[] = $entretien;
            $entretien->setMobiliers($this);
        }

        return $this;
    }

    public function removeEntretien(Entretien $entretien): self
    {
        if ($this->entretiens->contains($entretien)) {
            $this->entretiens->removeElement($entretien);
            // set the owning side to null (unless already changed)
            if ($entretien->getMobiliers() === $this) {
                $entretien->setMobiliers(null);
            }
        }

        return $this;
    }

    public function getService(): ?bool
    {
        return $this->service;
    }

    public function setService(bool $service): self
    {
        $this->service = $service;

        return $this;
    }
}
