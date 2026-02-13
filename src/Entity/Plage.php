<?php

namespace App\Entity;

use App\Repository\PlageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlageRepository::class)]
class Plage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heurFin = null;

    #[ORM\ManyToOne(inversedBy: 'plages')]
    private ?Intervention $intervention = null;

    #[ORM\ManyToOne(inversedBy: 'plages')]
    private ?JourDeLaSemaine $jourDeLaSemaine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?\DateTime
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTime $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeurFin(): ?\DateTime
    {
        return $this->heurFin;
    }

    public function setHeurFin(\DateTime $heurFin): static
    {
        $this->heurFin = $heurFin;

        return $this;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(?Intervention $intervention): static
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getJourDeLaSemaine(): ?JourDeLaSemaine
    {
        return $this->jourDeLaSemaine;
    }

    public function setJourDeLaSemaine(?JourDeLaSemaine $jourDeLaSemaine): static
    {
        $this->jourDeLaSemaine = $jourDeLaSemaine;

        return $this;
    }
}
