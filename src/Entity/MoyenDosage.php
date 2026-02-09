<?php

namespace App\Entity;

use App\Repository\MoyenDosageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoyenDosageRepository::class)]
class MoyenDosage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    /**
     * @var Collection<int, MeoProduit>
     */
    #[ORM\OneToMany(targetEntity: MeoProduit::class, mappedBy: 'moyenDosage')]
    private Collection $meoProduits;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

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
            $meoProduit->setMoyenDosage($this);
        }

        return $this;
    }

    public function removeMeoProduit(MeoProduit $meoProduit): static
    {
        if ($this->meoProduits->removeElement($meoProduit)) {
            // set the owning side to null (unless already changed)
            if ($meoProduit->getMoyenDosage() === $this) {
                $meoProduit->setMoyenDosage(null);
            }
        }

        return $this;
    }
}
