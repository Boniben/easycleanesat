<?php

namespace App\Entity;

use App\Repository\ContenantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenantRepository::class)]
class Contenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $volumeEau = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVolumeEau(): ?int
    {
        return $this->volumeEau;
    }

    public function setVolumeEau(?int $volumeEau): static
    {
        $this->volumeEau = $volumeEau;

        return $this;
    }

    public function getPicto(): ?string
    {
        return $this->picto;
    }

    public function setPicto(?string $picto): static
    {
        $this->picto = $picto;

        return $this;
    }
}
