<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterielRepository")
 * @UniqueEntity("nomenclature",message="Ce materiel existe déjà")
 */
class Materiel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $nomenclature;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $designation;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteInitiale;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $stockAlerte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="materiels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieMateriel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournirMateriel", mappedBy="materiels", orphanRemoval=true)
     */
    private $fournirMateriels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetenirMateriel", mappedBy="materiels")
     */
    private $detenirMateriels;

    /**
     * @ORM\Column(type="boolean")
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $etatRetourMateriel;

    public function __construct()
    {
        $this->fournirMateriels = new ArrayCollection();
        $this->detenirMateriels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomenclature(): ?string
    {
        return $this->nomenclature;
    }

    public function setNomenclature(string $nomenclature): self
    {
        $this->nomenclature = $nomenclature;

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

    public function getQteInitiale(): ?int
    {
        return $this->qteInitiale;
    }

    public function setQteInitiale(int $qteInitiale): self
    {
        $this->qteInitiale = $qteInitiale;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStockAlerte(): ?int
    {
        return $this->stockAlerte;
    }

    public function setStockAlerte(int $stockAlerte): self
    {
        $this->stockAlerte = $stockAlerte;

        return $this;
    }

    public function getCategorieMateriel(): ?Categorie
    {
        return $this->categorieMateriel;
    }

    public function setCategorieMateriel(?Categorie $categorieMateriel): self
    {
        $this->categorieMateriel = $categorieMateriel;

        return $this;
    }

    /**
     * @return Collection|FournirMateriel[]
     */
    public function getFournirMateriels(): Collection
    {
        return $this->fournirMateriels;
    }

    public function addFournirMateriel(FournirMateriel $fournirMateriel): self
    {
        if (!$this->fournirMateriels->contains($fournirMateriel)) {
            $this->fournirMateriels[] = $fournirMateriel;
            $fournirMateriel->setMateriels($this);
        }

        return $this;
    }

    public function removeFournirMateriel(FournirMateriel $fournirMateriel): self
    {
        if ($this->fournirMateriels->contains($fournirMateriel)) {
            $this->fournirMateriels->removeElement($fournirMateriel);
            // set the owning side to null (unless already changed)
            if ($fournirMateriel->getMateriels() === $this) {
                $fournirMateriel->setMateriels(null);
            }
        }

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
            $detenirMateriel->setMateriels($this);
        }

        return $this;
    }

    public function removeDetenirMateriel(DetenirMateriel $detenirMateriel): self
    {
        if ($this->detenirMateriels->contains($detenirMateriel)) {
            $this->detenirMateriels->removeElement($detenirMateriel);
            // set the owning side to null (unless already changed)
            if ($detenirMateriel->getMateriels() === $this) {
                $detenirMateriel->setMateriels(null);
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

    public function getEtatRetourMateriel(): ?string
    {
        return $this->etatRetourMateriel;
    }

    public function setEtatRetourMateriel(string $etatRetourMateriel): self
    {
        $this->etatRetourMateriel = $etatRetourMateriel;

        return $this;
    }
}
