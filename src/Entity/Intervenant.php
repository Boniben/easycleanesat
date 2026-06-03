<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_naissance = null;

    /**
     * @var Collection<int, DateIntervenationIntervenant>
     */
    #[ORM\OneToMany(targetEntity: DateIntervenationIntervenant::class, mappedBy: 'intervenant')]
    private Collection $dateIntervenationIntervenants;

    /**
     * @var Collection<int, Responsable>
     */
    #[ORM\OneToMany(targetEntity: Responsable::class, mappedBy: 'intervenant')]
    private Collection $responsables;

    /**
     * @var Collection<int, Handicap>
     */
    #[ORM\OneToMany(targetEntity: Handicap::class, mappedBy: 'intervenant')]
    private Collection $handicaps;

    public function __construct()
    {
        $this->dateIntervenationIntervenants = new ArrayCollection();
        $this->responsables = new ArrayCollection();
        $this->handicaps = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTime $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return Collection<int, DateIntervenationIntervenant>
     */
    public function getDateIntervenationIntervenants(): Collection
    {
        return $this->dateIntervenationIntervenants;
    }

    public function addDateIntervenationIntervenant(DateIntervenationIntervenant $dateIntervenationIntervenant): static
    {
        if (!$this->dateIntervenationIntervenants->contains($dateIntervenationIntervenant)) {
            $this->dateIntervenationIntervenants->add($dateIntervenationIntervenant);
            $dateIntervenationIntervenant->setIntervenant($this);
        }

        return $this;
    }

    public function removeDateIntervenationIntervenant(DateIntervenationIntervenant $dateIntervenationIntervenant): static
    {
        if ($this->dateIntervenationIntervenants->removeElement($dateIntervenationIntervenant)) {
            // set the owning side to null (unless already changed)
            if ($dateIntervenationIntervenant->getIntervenant() === $this) {
                $dateIntervenationIntervenant->setIntervenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Responsable>
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): static
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables->add($responsable);
            $responsable->setIntervenant($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): static
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getIntervenant() === $this) {
                $responsable->setIntervenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Handicap>
     */
    public function getHandicaps(): Collection
    {
        return $this->handicaps;
    }

    public function addHandicap(Handicap $handicap): static
    {
        if (!$this->handicaps->contains($handicap)) {
            $this->handicaps->add($handicap);
            $handicap->setIntervenant($this);
        }

        return $this;
    }

    public function removeHandicap(Handicap $handicap): static
    {
        if ($this->handicaps->removeElement($handicap)) {
            // set the owning side to null (unless already changed)
            if ($handicap->getIntervenant() === $this) {
                $handicap->setIntervenant(null);
            }
        }

        return $this;
    }
}
