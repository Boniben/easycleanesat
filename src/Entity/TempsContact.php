<?php

namespace App\Entity;

use App\Repository\TempsContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TempsContactRepository::class)]
class TempsContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $tempsContact = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    /**
     * @var Collection<int, MeoProduit>
     */
    #[ORM\OneToMany(targetEntity: MeoProduit::class, mappedBy: 'tempsContact')]
    private Collection $meoProduits;

    public function __construct()
    {
        $this->meoProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempsContact(): ?int
    {
        return $this->tempsContact;
    }

    public function setTempsContact(int $tempsContact): static
    {
        $this->tempsContact = $tempsContact;

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
            $meoProduit->setTempsContact($this);
        }

        return $this;
    }

    public function removeMeoProduit(MeoProduit $meoProduit): static
    {
        if ($this->meoProduits->removeElement($meoProduit)) {
            // set the owning side to null (unless already changed)
            if ($meoProduit->getTempsContact() === $this) {
                $meoProduit->setTempsContact(null);
            }
        }

        return $this;
    }
}
