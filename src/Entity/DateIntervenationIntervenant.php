<?php

namespace App\Entity;

use App\Repository\DateIntervenationIntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateIntervenationIntervenantRepository::class)]
class DateIntervenationIntervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date_intervention = null;

    #[ORM\ManyToOne(inversedBy: 'intervenant')]
    private ?Intervention $intervention = null;

    #[ORM\ManyToOne(inversedBy: 'dateIntervenationIntervenants')]
    private ?Intervenant $intervenant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIntervention(): ?\DateTime
    {
        return $this->date_intervention;
    }

    public function setDateIntervention(\DateTime $date_intervention): static
    {
        $this->date_intervention = $date_intervention;

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
