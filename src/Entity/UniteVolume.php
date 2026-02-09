<?php

namespace App\Entity;

use App\Repository\UniteVolumeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteVolumeRepository::class)]
class UniteVolume
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nom = null;

    /**
     * @var Collection<int, MeoProduit>
     */
    #[ORM\OneToMany(targetEntity: MeoProduit::class, mappedBy: 'uniteVolume')]
    private Collection $meoProduits;

    /**
     * @var Collection<int, Contenant>
     */
    #[ORM\OneToMany(targetEntity: Contenant::class, mappedBy: 'uniteVolume')]
    private Collection $contenants;

    public function __construct()
    {
        $this->meoProduits = new ArrayCollection();
        $this->contenants = new ArrayCollection();
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
     * @return Collection<int, MeoProduit>
     */
    public function getMeoProduits(): Collection
    {
        return $this->meoProduits;
    }

    public function addMeoProduit(MeoProduit $meoProduit): static
    {
        if (!$this->meoProduits->contains($meoProduit)) {
            $this->meoProduits->add($meoProduit);
            $meoProduit->setUniteVolume($this);
        }

        return $this;
    }

    public function removeMeoProduit(MeoProduit $meoProduit): static
    {
        if ($this->meoProduits->removeElement($meoProduit)) {
            // set the owning side to null (unless already changed)
            if ($meoProduit->getUniteVolume() === $this) {
                $meoProduit->setUniteVolume(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contenant>
     */
    public function getContenants(): Collection
    {
        return $this->contenants;
    }

    public function addContenant(Contenant $contenant): static
    {
        if (!$this->contenants->contains($contenant)) {
            $this->contenants->add($contenant);
            $contenant->setUniteVolume($this);
        }

        return $this;
    }

    public function removeContenant(Contenant $contenant): static
    {
        if ($this->contenants->removeElement($contenant)) {
            // set the owning side to null (unless already changed)
            if ($contenant->getUniteVolume() === $this) {
                $contenant->setUniteVolume(null);
            }
        }

        return $this;
    }
}
