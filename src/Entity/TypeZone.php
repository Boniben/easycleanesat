<?php

namespace App\Entity;

use App\Repository\TypeZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeZoneRepository::class)]
class TypeZone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $picto = null;

    /**
     * @var Collection<int, ZonesClient>
     */
    #[ORM\OneToMany(targetEntity: ZonesClient::class, mappedBy: 'typeZone')]
    private Collection $zonesClients;

    public function __construct()
    {
        $this->zonesClients = new ArrayCollection();
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

    public function getPicto(): ?string
    {
        return $this->picto;
    }

    public function setPicto(string $picto): static
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * @return Collection<int, ZonesClient>
     */
    public function getZonesClients(): Collection
    {
        return $this->zonesClients;
    }

    public function addZonesClient(ZonesClient $zonesClient): static
    {
        if (!$this->zonesClients->contains($zonesClient)) {
            $this->zonesClients->add($zonesClient);
            $zonesClient->setTypeZone($this);
        }

        return $this;
    }

    public function removeZonesClient(ZonesClient $zonesClient): static
    {
        if ($this->zonesClients->removeElement($zonesClient)) {
            // set the owning side to null (unless already changed)
            if ($zonesClient->getTypeZone() === $this) {
                $zonesClient->setTypeZone(null);
            }
        }

        return $this;
    }
}
