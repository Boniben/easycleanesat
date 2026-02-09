<?php

namespace App\Entity;

use App\Repository\MoyenDosageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoyenDosageRepository::class)]
class MoyenDosage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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
