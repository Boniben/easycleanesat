<?php

namespace App\Entity;

use App\Repository\TempsContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TempsContactRepository::class)]
class TempsContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $tempsContact = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempsContact(): ?int
    {
        return $this->tempsContact;
    }

    public function setTempsContact(int $tempsContact): static
    {
        $this->tempsContact = $tempsContact;

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
