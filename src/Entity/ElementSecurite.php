<?php

namespace App\Entity;

use App\Repository\ElementSecuriteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementSecuriteRepository::class)]
class ElementSecurite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picto = null;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\ManyToMany(targetEntity: Intervention::class, inversedBy: 'elementSecurites')]
    private Collection $intervention;

    public function __construct()
    {
        $this->intervention = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

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
     * @return Collection<int, Intervention>
     */
    public function getIntervention(): Collection
    {
        return $this->intervention;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->intervention->contains($intervention)) {
            $this->intervention->add($intervention);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        $this->intervention->removeElement($intervention);

        return $this;
    }
}
