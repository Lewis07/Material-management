<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FonctionRepository")
 * @UniqueEntity("libelle",message="Ce fonction existe déjà")
 */
class Fonction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detenteur", mappedBy="fonction")
     */
    private $detenteurs;

    public function __construct()
    {
        $this->detenteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Detenteur[]
     */
    public function getDetenteurs(): Collection
    {
        return $this->detenteurs;
    }

    public function addDetenteur(Detenteur $detenteur): self
    {
        if (!$this->detenteurs->contains($detenteur)) {
            $this->detenteurs[] = $detenteur;
            $detenteur->setFonction($this);
        }

        return $this;
    }

    public function removeDetenteur(Detenteur $detenteur): self
    {
        if ($this->detenteurs->contains($detenteur)) {
            $this->detenteurs->removeElement($detenteur);
            // set the owning side to null (unless already changed)
            if ($detenteur->getFonction() === $this) {
                $detenteur->setFonction(null);
            }
        }

        return $this;
    }
}
