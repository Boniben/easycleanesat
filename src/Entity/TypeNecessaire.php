<?php

namespace App\Entity;

use App\Repository\TypeNecessaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeNecessaireRepository::class)]
class TypeNecessaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?bool $obligatoire = null;

    /**
     * @var Collection<int, Necessaire>
     */
    #[ORM\OneToMany(targetEntity: Necessaire::class, mappedBy: 'type_necessaire')]
    private Collection $necessaires;

    public function __construct()
    {
        $this->necessaires = new ArrayCollection();
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

    public function isObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): static
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    /**
     * @return Collection<int, Necessaire>
     */
    public function getNecessaires(): Collection
    {
        return $this->necessaires;
    }

    public function addNecessaire(Necessaire $necessaire): static
    {
        if (!$this->necessaires->contains($necessaire)) {
            $this->necessaires->add($necessaire);
            $necessaire->setTypeNecessaire($this);
        }

        return $this;
    }

    public function removeNecessaire(Necessaire $necessaire): static
    {
        if ($this->necessaires->removeElement($necessaire)) {
            // set the owning side to null (unless already changed)
            if ($necessaire->getTypeNecessaire() === $this) {
                $necessaire->setTypeNecessaire(null);
            }
        }

        return $this;
    }
}
