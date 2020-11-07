<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetenirMaterielRepository")
 *  @UniqueEntity(
 *     fields={"detenteurs", "materiels"},
 *     errorPath="port",
 *     message="Ce materiel est déjà detenu par un detenteur"
 * )
 */
class DetenirMateriel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateSortie;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteSortie;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $lieu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRetour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Detenteur", inversedBy="detenirMateriels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $detenteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="detenirMateriels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiels;

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

    public function getMateriels(): ?Materiel
    {
        return $this->materiels;
    }

    public function setMateriels(?Materiel $materiels): self
    {
        $this->materiels = $materiels;

        return $this;
    }
}
