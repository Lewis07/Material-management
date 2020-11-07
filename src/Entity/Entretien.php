<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntretienRepository")
 */
class Entretien
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
    private $dateDebut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mobilier", inversedBy="entretiens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobiliers;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $descriptionEntretien;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

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

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescriptionEntretien(): ?string
    {
        return $this->descriptionEntretien;
    }

    public function setDescriptionEntretien(?string $descriptionEntretien): self
    {
        $this->descriptionEntretien = $descriptionEntretien;

        return $this;
    }

    
}
