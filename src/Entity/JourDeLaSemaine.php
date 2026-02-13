<?php

namespace App\Entity;

use App\Repository\JourDeLaSemaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourDeLaSemaineRepository::class)]
class JourDeLaSemaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Plage>
     */
    #[ORM\OneToMany(targetEntity: Plage::class, mappedBy: 'jourDeLaSemaine')]
    private Collection $plages;

    public function __construct()
    {
        $this->plages = new ArrayCollection();
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

    /**
     * @return Collection<int, Plage>
     */
    public function getPlages(): Collection
    {
        return $this->plages;
    }

    public function addPlage(Plage $plage): static
    {
        if (!$this->plages->contains($plage)) {
            $this->plages->add($plage);
            $plage->setJourDeLaSemaine($this);
        }

        return $this;
    }

    public function removePlage(Plage $plage): static
    {
        if ($this->plages->removeElement($plage)) {
            // set the owning side to null (unless already changed)
            if ($plage->getJourDeLaSemaine() === $this) {
                $plage->setJourDeLaSemaine(null);
            }
        }

        return $this;
    }
}
