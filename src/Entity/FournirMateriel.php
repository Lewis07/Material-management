<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournirMaterielRepository")
 */
//  * @UniqueEntity(
//  *     fields={"sources", "materiels"},
//  *     errorPath="port",
//  *     message="Ce materiel est déjà fourni par un source"
//  * )
class FournirMateriel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEntree;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteEntree;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $nature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="fournirMateriels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sources;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="fournirMateriels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiels;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixMateriel;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getQteEntree(): ?int
    {
        return $this->qteEntree;
    }

    public function setQteEntree(int $qteEntree): self
    {
        $this->qteEntree = $qteEntree;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getSources(): ?Source
    {
        return $this->sources;
    }

    public function setSources(?Source $sources): self
    {
        $this->sources = $sources;

        return $this;
    }

    public function getMateriels(): ?Materiel
    {
        return $this->materiels;
    }

    public function setMateriels(?Materiel $materiels): self
    {
        $this->materiels = $materiels;

        return $this;
    }

    public function getPrixMateriel(): ?int
    {
        return $this->prixMateriel;
    }

    public function setPrixMateriel(?int $prixMateriel): self
    {
        $this->prixMateriel = $prixMateriel;

        return $this;
    }

    
}
