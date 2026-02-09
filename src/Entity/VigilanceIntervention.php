<?php

namespace App\Entity;

use App\Repository\VigilanceInterventionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VigilanceInterventionRepository::class)]
class VigilanceIntervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    #[ORM\ManyToOne(inversedBy: 'vigilanceInterventions')]
    private ?Vigilance $vigilance = null;

    #[ORM\ManyToOne(inversedBy: 'vigilanceInterventions')]
    private ?Intervention $intervention = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getVigilance(): ?Vigilance
    {
        return $this->vigilance;
    }

    public function setVigilance(?Vigilance $vigilance): static
    {
        $this->vigilance = $vigilance;

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
}
