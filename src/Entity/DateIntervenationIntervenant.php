<?php

namespace App\Entity;

use App\Repository\DateIntervenationIntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Table de liaison entre une Intervention et un Intervenant.
 *
 * Chaque enregistrement représente l'affectation d'un intervenant
 * à une fiche intervention précise. Il stocke également :
 * - Le responsable désigné pour CET intervenant sur CETTE intervention
 *   (propre à la fiche, indépendant de tout lien global).
 * - La date de pointage (null jusqu'à ce que l'intervenant pointe son arrivée).
 */
#[ORM\Entity(repositoryClass: DateIntervenationIntervenantRepository::class)]
class DateIntervenationIntervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Date/heure de pointage de l'intervenant — remplie lors du pointage (phase 2).
    #[ORM\Column(nullable: true)]
    private ?\DateTime $date_intervention = null;

    // La fiche intervention concernée.
    #[ORM\ManyToOne(inversedBy: 'DateIntervenationIntervenant')]
    private ?Intervention $intervention = null;

    // L'intervenant affecté à cette fiche.
    #[ORM\ManyToOne(inversedBy: 'dateIntervenationIntervenants')]
    private ?Intervenant $intervenant = null;

    // Responsable assigné à cet intervenant pour cette intervention uniquement.
    // Choisi lors de la création/modification de la fiche.
    #[ORM\ManyToOne]
    private ?Responsable $responsable = null;

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

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): static
    {
        $this->responsable = $responsable;

        return $this;
    }
}
