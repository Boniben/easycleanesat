<?php

namespace App\Entity;

use App\Repository\ActionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionsRepository::class)]
class Actions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Materiel $materiel = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Accessoire $accessoire = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Reutilisable $reutilisable = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Consommable $consommable = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Tache $tache = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?Support $support = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    private ?MeoProduit $meo_produit = null;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Intervention $intervention = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): static
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getAccessoire(): ?Accessoire
    {
        return $this->accessoire;
    }

    public function setAccessoire(?Accessoire $accessoire): static
    {
        $this->accessoire = $accessoire;

        return $this;
    }

    public function getReutilisable(): ?Reutilisable
    {
        return $this->reutilisable;
    }

    public function setReutilisable(?Reutilisable $reutilisable): static
    {
        $this->reutilisable = $reutilisable;

        return $this;
    }

    public function getConsommable(): ?Consommable
    {
        return $this->consommable;
    }

    public function setConsommable(?Consommable $consommable): static
    {
        $this->consommable = $consommable;

        return $this;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(?Tache $tache): static
    {
        $this->tache = $tache;

        return $this;
    }

    public function getSupport(): ?Support
    {
        return $this->support;
    }

    public function setSupport(?Support $support): static
    {
        $this->support = $support;

        return $this;
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
}
