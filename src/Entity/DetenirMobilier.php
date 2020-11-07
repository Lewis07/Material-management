<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetenirMobilierRepository")
 * @UniqueEntity(
 *     fields={"detenteurs", "mobiliers"},
 *     errorPath="port",
 *     message="Ce mobilier est déjà detenu par un detenteur"
 * )
 */
class DetenirMobilier
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
    private $dateSortie;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteSortie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lieu;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Detenteur", inversedBy="detenirMobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $detenteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mobilier", inversedBy="detenirMobiliers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobiliers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getQteSortie(): ?int
    {
        return $this->qteSortie;
    }

    public function setQteSortie(int $qteSortie): self
    {
        $this->qteSortie = $qteSortie;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getDetenteurs(): ?Detenteur
    {
        return $this->detenteurs;
    }

    public function setDetenteurs(?Detenteur $detenteurs): self
    {
        $this->detenteurs = $detenteurs;

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
}
