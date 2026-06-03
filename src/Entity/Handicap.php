<?php

namespace App\Entity;

use App\Repository\HandicapRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HandicapRepository::class)]
class Handicap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_handicap = null;

    #[ORM\ManyToOne(inversedBy: 'handicaps')]
    private ?Intervenant $intervenant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeHandicap(): ?string
    {
        return $this->type_handicap;
    }

    public function setTypeHandicap(string $type_handicap): static
    {
        $this->type_handicap = $type_handicap;

        return $this;
    }

    public function getIntervenant(): ?Intervenant
    {
        return $this->intervenant;
    }

    public function setIntervenant(?Intervenant $intervenant): static
    {
        $this->intervenant = $intervenant;

        return $this;
    }
}
