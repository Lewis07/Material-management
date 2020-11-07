<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeclarationRepository")
 * @UniqueEntity(
 *     fields={"detenteurs", "contenu"},
 *     errorPath="port",
 *     message="Ce contenu est déjà écrit par vous"
 * )
 */
class Declaration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Detenteur", inversedBy="declarations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $detenteurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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
}
