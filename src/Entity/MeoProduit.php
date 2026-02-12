<?php

namespace App\Entity;

use App\Repository\MeoProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeoProduitRepository::class)]
class MeoProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $volumeProduit = null;

    #[ORM\ManyToOne(inversedBy: 'meoProduits')]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'meoProduits')]
    private ?Contenant $contenant = null;

    #[ORM\ManyToOne(inversedBy: 'meoProduits')]
    private ?UniteVolume $uniteVolume = null;

    #[ORM\ManyToOne(inversedBy: 'meoProduits')]
    private ?MoyenDosage $moyenDosage = null;

    #[ORM\ManyToOne(inversedBy: 'meoProduits')]
    private ?TempsContact $tempsContact = null;

    /**
     * @var Collection<int, Actions>
     */
    #[ORM\OneToMany(targetEntity: Actions::class, mappedBy: 'meo_produit')]
    private Collection $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVolumeProduit(): ?int
    {
        return $this->volumeProduit;
    }

    public function setVolumeProduit(?int $volumeProduit): static
    {
        $this->volumeProduit = $volumeProduit;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getContenant(): ?Contenant
    {
        return $this->contenant;
    }

    public function setContenant(?Contenant $contenant): static
    {
        $this->contenant = $contenant;

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

    public function getMoyenDosage(): ?MoyenDosage
    {
        return $this->moyenDosage;
    }

    public function setMoyenDosage(?MoyenDosage $moyenDosage): static
    {
        $this->moyenDosage = $moyenDosage;

        return $this;
    }

    public function getTempsContact(): ?TempsContact
    {
        return $this->tempsContact;
    }

    public function setTempsContact(?TempsContact $tempsContact): static
    {
        $this->tempsContact = $tempsContact;

        return $this;
    }

    /**
     * @return Collection<int, Actions>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Actions $action): static
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->setMeoProduit($this);
        }

        return $this;
    }

    public function removeAction(Actions $action): static
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getMeoProduit() === $this) {
                $action->setMeoProduit(null);
            }
        }

        return $this;
    }
}
