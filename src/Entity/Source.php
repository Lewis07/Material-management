<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceRepository")
 * @UniqueEntity("nomSource",message="Ce source existe déjà")
 */
class Source
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $nomSource;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournirMateriel", mappedBy="sources", orphanRemoval=true)
     */
    private $fournirMateriels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FournirMobilier", mappedBy="sources")
     */
    private $fournirMobiliers;

    public function __construct()
    {
        $this->fournirMateriels = new ArrayCollection();
        $this->fournirMobiliers = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSource(): ?string
    {
        return $this->nomSource;
    }

    public function setNomSource(string $nomSource): self
    {
        $this->nomSource = $nomSource;

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
            $fournirMateriel->setSources($this);
        }

        return $this;
    }

    public function removeFournirMateriel(FournirMateriel $fournirMateriel): self
    {
        if ($this->fournirMateriels->contains($fournirMateriel)) {
            $this->fournirMateriels->removeElement($fournirMateriel);
            // set the owning side to null (unless already changed)
            if ($fournirMateriel->getSources() === $this) {
                $fournirMateriel->setSources(null);
            }
        }

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
            $fournirMobilier->setSources($this);
        }

        return $this;
    }

    public function removeFournirMobilier(FournirMobilier $fournirMobilier): self
    {
        if ($this->fournirMobiliers->contains($fournirMobilier)) {
            $this->fournirMobiliers->removeElement($fournirMobilier);
            // set the owning side to null (unless already changed)
            if ($fournirMobilier->getSources() === $this) {
                $fournirMobilier->setSources(null);
            }
        }

        return $this;
    }
}
