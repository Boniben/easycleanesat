<?php

namespace App\Entity;

use App\Repository\HandicapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Intervenant>
     */
    #[ORM\OneToMany(targetEntity: Intervenant::class, mappedBy: 'handicap')]
    private Collection $intervenants;

    public function __construct()
    {
        $this->intervenants = new ArrayCollection();
    }

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


    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Intervenant $intervenant): static
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
            $intervenant->setHandicap($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): static
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getHandicap() === $this) {
                $intervenant->setHandicap(null);
            }
        }

        return $this;
    }
}
