<?php

namespace App\Entity;

use App\Repository\ZonesClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZonesClientRepository::class)]
class ZonesClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'zonesClients')]
    private ?SitesClient $sitesClient = null;

    #[ORM\ManyToOne(inversedBy: 'zonesClients')]
    private ?TypeZone $typeZone = null;

    /**
     * @var Collection<int, SupportClient>
     */
    #[ORM\OneToMany(targetEntity: SupportClient::class, mappedBy: 'zonesClient')]
    private Collection $y;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'zonesClient')]
    private Collection $interventions;

    public function __construct()
    {
        $this->y = new ArrayCollection();
        $this->interventions = new ArrayCollection();
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

    public function getSitesClient(): ?SitesClient
    {
        return $this->sitesClient;
    }

    public function setSitesClient(?SitesClient $sitesClient): static
    {
        $this->sitesClient = $sitesClient;

        return $this;
    }

    public function getTypeZone(): ?TypeZone
    {
        return $this->typeZone;
    }

    public function setTypeZone(?TypeZone $typeZone): static
    {
        $this->typeZone = $typeZone;

        return $this;
    }

    /**
     * @return Collection<int, SupportClient>
     */
    public function getY(): Collection
    {
        return $this->y;
    }

    public function addY(SupportClient $y): static
    {
        if (!$this->y->contains($y)) {
            $this->y->add($y);
            $y->setZonesClient($this);
        }

        return $this;
    }

    public function removeY(SupportClient $y): static
    {
        if ($this->y->removeElement($y)) {
            // set the owning side to null (unless already changed)
            if ($y->getZonesClient() === $this) {
                $y->setZonesClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setZonesClient($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getZonesClient() === $this) {
                $intervention->setZonesClient(null);
            }
        }

        return $this;
    }
}
