<?php

namespace App\Entity;

use App\Repository\ActionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionsRepository::class)]
class Actions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?MeoProduit $meo_produit = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Intervention $intervention = null;

    /**
     * @var Collection<int, Necessaire>
     */
    #[ORM\ManyToMany(targetEntity: Necessaire::class, inversedBy: 'actions')]
    private Collection $necessaire;

    public function __construct()
    {
        $this->necessaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeoProduit(): ?MeoProduit
    {
        return $this->meo_produit;
    }

    public function setMeoProduit(?MeoProduit $meo_produit): static
    {
        $this->meo_produit = $meo_produit;

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

    /**
     * @return Collection<int, Necessaire>
     */
    public function getNecessaire(): Collection
    {
        return $this->necessaire;
    }

    public function addNecessaire(Necessaire $necessaire): static
    {
        if (!$this->necessaire->contains($necessaire)) {
            $this->necessaire->add($necessaire);
        }

        return $this;
    }

    public function removeNecessaire(Necessaire $necessaire): static
    {
        $this->necessaire->removeElement($necessaire);

        return $this;
    }
}
