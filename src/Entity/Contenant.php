<?php

namespace App\Entity;

use App\Repository\ContenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenantRepository::class)]
class Contenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?float $volumeEau = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    /**
     * @var Collection<int, MeoProduit>
     */
    #[ORM\OneToMany(targetEntity: MeoProduit::class, mappedBy: 'contenant')]
    private Collection $meoProduits;

    #[ORM\ManyToOne(inversedBy: 'contenants')]
    private ?UniteVolume $uniteVolume = null;

    public function __construct()
    {
        $this->meoProduits = new ArrayCollection();
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

    public function getVolumeEau(): ?int
    {
        return $this->volumeEau;
    }

    public function setVolumeEau(?int $volumeEau): static
    {
        $this->volumeEau = $volumeEau;

        return $this;
    }

    public function getPicto(): ?string
    {
        return $this->picto;
    }

    public function setPicto(?string $picto): static
    {
        $this->picto = $picto;

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
            $meoProduit->setContenant($this);
        }

        return $this;
    }

    public function removeMeoProduit(MeoProduit $meoProduit): static
    {
        if ($this->meoProduits->removeElement($meoProduit)) {
            // set the owning side to null (unless already changed)
            if ($meoProduit->getContenant() === $this) {
                $meoProduit->setContenant(null);
            }
        }

        return $this;
    }

    public function getUniteVolume(): ?UniteVolume
    {
        return $this->uniteVolume;
    }

    public function setUniteVolume(?UniteVolume $uniteVolume): static
    {
        $this->uniteVolume = $uniteVolume;

        return $this;
    }
}
