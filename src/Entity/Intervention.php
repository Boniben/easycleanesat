<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $numVersion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateModification = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbTravailleur = null;

    #[ORM\Column(nullable: true)]
    private ?int $dureeHeure = null;

    #[ORM\Column(nullable: true)]
    private ?int $dureeMinute = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $lundiMatHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $lundiMatHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $lundiApHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $lundiApHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mardiMatHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mardiMatHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mardiApHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mardiApHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mercrediMatHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mercrediMatHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mercrediApHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $mercrediApHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $jeudiMatHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $jeudiMatHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $jeudiApHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $jeudiApHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $vendrediMatHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $vendrediMatHf = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $vendrediApHd = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $vendrediApHf = null;

    /**
     * @var Collection<int, ElementSecurite>
     */
    #[ORM\ManyToMany(targetEntity: ElementSecurite::class, mappedBy: 'intervention')]
    private Collection $elementSecurites;

    /**
     * @var Collection<int, VigilanceIntervention>
     */
    #[ORM\OneToMany(targetEntity: VigilanceIntervention::class, mappedBy: 'intervention')]
    private Collection $vigilanceInterventions;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Redacteur $redacteur = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ZonesClient $zonesClient = null;

    public function __construct()
    {
        $this->elementSecurites = new ArrayCollection();
        $this->vigilanceInterventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumVersion(): ?int
    {
        return $this->numVersion;
    }

    public function setNumVersion(?int $numVersion): static
    {
        $this->numVersion = $numVersion;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTime
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTime $dateModification): static
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getNbTravailleur(): ?int
    {
        return $this->nbTravailleur;
    }

    public function setNbTravailleur(?int $nbTravailleur): static
    {
        $this->nbTravailleur = $nbTravailleur;

        return $this;
    }

    public function getDureeHeure(): ?int
    {
        return $this->dureeHeure;
    }

    public function setDureeHeure(?int $dureeHeure): static
    {
        $this->dureeHeure = $dureeHeure;

        return $this;
    }

    public function getDureeMinute(): ?int
    {
        return $this->dureeMinute;
    }

    public function setDureeMinute(?int $dureeMinute): static
    {
        $this->dureeMinute = $dureeMinute;

        return $this;
    }

    public function getLundiMatHd(): ?\DateTime
    {
        return $this->lundiMatHd;
    }

    public function setLundiMatHd(?\DateTime $lundiMatHd): static
    {
        $this->lundiMatHd = $lundiMatHd;

        return $this;
    }

    public function getLundiMatHf(): ?\DateTime
    {
        return $this->lundiMatHf;
    }

    public function setLundiMatHf(?\DateTime $lundiMatHf): static
    {
        $this->lundiMatHf = $lundiMatHf;

        return $this;
    }

    public function getLundiApHd(): ?\DateTime
    {
        return $this->lundiApHd;
    }

    public function setLundiApHd(?\DateTime $lundiApHd): static
    {
        $this->lundiApHd = $lundiApHd;

        return $this;
    }

    public function getLundiApHf(): ?\DateTime
    {
        return $this->lundiApHf;
    }

    public function setLundiApHf(?\DateTime $lundiApHf): static
    {
        $this->lundiApHf = $lundiApHf;

        return $this;
    }

    public function getMardiMatHd(): ?\DateTime
    {
        return $this->mardiMatHd;
    }

    public function setMardiMatHd(?\DateTime $mardiMatHd): static
    {
        $this->mardiMatHd = $mardiMatHd;

        return $this;
    }

    public function getMardiMatHf(): ?\DateTime
    {
        return $this->mardiMatHf;
    }

    public function setMardiMatHf(?\DateTime $mardiMatHf): static
    {
        $this->mardiMatHf = $mardiMatHf;

        return $this;
    }

    public function getMardiApHd(): ?\DateTime
    {
        return $this->mardiApHd;
    }

    public function setMardiApHd(?\DateTime $mardiApHd): static
    {
        $this->mardiApHd = $mardiApHd;

        return $this;
    }

    public function getMardiApHf(): ?\DateTime
    {
        return $this->mardiApHf;
    }

    public function setMardiApHf(?\DateTime $mardiApHf): static
    {
        $this->mardiApHf = $mardiApHf;

        return $this;
    }

    public function getMercrediMatHd(): ?\DateTime
    {
        return $this->mercrediMatHd;
    }

    public function setMercrediMatHd(?\DateTime $mercrediMatHd): static
    {
        $this->mercrediMatHd = $mercrediMatHd;

        return $this;
    }

    public function getMercrediMatHf(): ?\DateTime
    {
        return $this->mercrediMatHf;
    }

    public function setMercrediMatHf(?\DateTime $mercrediMatHf): static
    {
        $this->mercrediMatHf = $mercrediMatHf;

        return $this;
    }

    public function getMercrediApHd(): ?\DateTime
    {
        return $this->mercrediApHd;
    }

    public function setMercrediApHd(?\DateTime $mercrediApHd): static
    {
        $this->mercrediApHd = $mercrediApHd;

        return $this;
    }

    public function getMercrediApHf(): ?\DateTime
    {
        return $this->mercrediApHf;
    }

    public function setMercrediApHf(?\DateTime $mercrediApHf): static
    {
        $this->mercrediApHf = $mercrediApHf;

        return $this;
    }

    public function getJeudiMatHd(): ?\DateTime
    {
        return $this->jeudiMatHd;
    }

    public function setJeudiMatHd(?\DateTime $jeudiMatHd): static
    {
        $this->jeudiMatHd = $jeudiMatHd;

        return $this;
    }

    public function getJeudiMatHf(): ?\DateTime
    {
        return $this->jeudiMatHf;
    }

    public function setJeudiMatHf(?\DateTime $jeudiMatHf): static
    {
        $this->jeudiMatHf = $jeudiMatHf;

        return $this;
    }

    public function getJeudiApHd(): ?\DateTime
    {
        return $this->jeudiApHd;
    }

    public function setJeudiApHd(?\DateTime $jeudiApHd): static
    {
        $this->jeudiApHd = $jeudiApHd;

        return $this;
    }

    public function getJeudiApHf(): ?\DateTime
    {
        return $this->jeudiApHf;
    }

    public function setJeudiApHf(?\DateTime $jeudiApHf): static
    {
        $this->jeudiApHf = $jeudiApHf;

        return $this;
    }

    public function getVendrediMatHd(): ?\DateTime
    {
        return $this->vendrediMatHd;
    }

    public function setVendrediMatHd(?\DateTime $vendrediMatHd): static
    {
        $this->vendrediMatHd = $vendrediMatHd;

        return $this;
    }

    public function getVendrediMatHf(): ?\DateTime
    {
        return $this->vendrediMatHf;
    }

    public function setVendrediMatHf(?\DateTime $vendrediMatHf): static
    {
        $this->vendrediMatHf = $vendrediMatHf;

        return $this;
    }

    public function getVendrediApHd(): ?\DateTime
    {
        return $this->vendrediApHd;
    }

    public function setVendrediApHd(?\DateTime $vendrediApHd): static
    {
        $this->vendrediApHd = $vendrediApHd;

        return $this;
    }

    public function getVendrediApHf(): ?\DateTime
    {
        return $this->vendrediApHf;
    }

    public function setVendrediApHf(?\DateTime $vendrediApHf): static
    {
        $this->vendrediApHf = $vendrediApHf;

        return $this;
    }

    /**
     * @return Collection<int, ElementSecurite>
     */
    public function getElementSecurites(): Collection
    {
        return $this->elementSecurites;
    }

    public function addElementSecurite(ElementSecurite $elementSecurite): static
    {
        if (!$this->elementSecurites->contains($elementSecurite)) {
            $this->elementSecurites->add($elementSecurite);
            $elementSecurite->addIntervention($this);
        }

        return $this;
    }

    public function removeElementSecurite(ElementSecurite $elementSecurite): static
    {
        if ($this->elementSecurites->removeElement($elementSecurite)) {
            $elementSecurite->removeIntervention($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, VigilanceIntervention>
     */
    public function getVigilanceInterventions(): Collection
    {
        return $this->vigilanceInterventions;
    }

    public function addVigilanceIntervention(VigilanceIntervention $vigilanceIntervention): static
    {
        if (!$this->vigilanceInterventions->contains($vigilanceIntervention)) {
            $this->vigilanceInterventions->add($vigilanceIntervention);
            $vigilanceIntervention->setIntervention($this);
        }

        return $this;
    }

    public function removeVigilanceIntervention(VigilanceIntervention $vigilanceIntervention): static
    {
        if ($this->vigilanceInterventions->removeElement($vigilanceIntervention)) {
            // set the owning side to null (unless already changed)
            if ($vigilanceIntervention->getIntervention() === $this) {
                $vigilanceIntervention->setIntervention(null);
            }
        }

        return $this;
    }

    public function getRedacteur(): ?Redacteur
    {
        return $this->redacteur;
    }

    public function setRedacteur(?Redacteur $redacteur): static
    {
        $this->redacteur = $redacteur;

        return $this;
    }

    public function getZonesClient(): ?ZonesClient
    {
        return $this->zonesClient;
    }

    public function setZonesClient(?ZonesClient $zonesClient): static
    {
        $this->zonesClient = $zonesClient;

        return $this;
    }
}
