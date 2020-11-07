<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournirMobilierRepository")
 * @UniqueEntity(
 *     fields={"sources", "mobiliers"},
 *     errorPath="port",
 *     message="Ce mobilier est déjà fourni par un source"
 * )
 */
class FournirMobilier
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="fournirMobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sources;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mobilier", inversedBy="fournirMobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobiliers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixMobilier;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $nature;

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

    public function getSources(): ?Source
    {
        return $this->sources;
    }

    public function setSources(?Source $sources): self
    {
        $this->sources = $sources;

        return $this;
    }

    public function getMobiliers(): ?Mobilier
    {
        return $this->mobiliers;
    }

    public function setMobiliers(?Mobilier $mobiliers): self
    {
        $this->mobiliers = $mobiliers;

        return $this;
    }

    public function getPrixMobilier(): ?int
    {
        return $this->prixMobilier;
    }

    public function setPrixMobilier(?int $prixMobilier): self
    {
        $this->prixMobilier = $prixMobilier;

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
}
