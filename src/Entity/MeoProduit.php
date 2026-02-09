<?php

namespace App\Entity;

use App\Repository\MeoProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeoProduitRepository::class)]
class MeoProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $volumeProduit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVolumeProduit(): ?int
    {
        return $this->volumeProduit;
    }

    public function setVolumeProduit(?int $volumeProduit): static
    {
        $this->volumeProduit = $volumeProduit;

        return $this;
    }
}
