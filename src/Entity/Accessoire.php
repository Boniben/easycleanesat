<?php

namespace App\Entity;

use App\Repository\AccessoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoireRepository::class)]
class Accessoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $code = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $picto = null;

    /**
     * @var Collection<int, Actions>
     */
    #[ORM\OneToMany(targetEntity: Actions::class, mappedBy: 'accessoire')]
    private Collection $actions;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
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
            $action->setAccessoire($this);
        }

        return $this;
    }

    public function removeAction(Actions $action): static
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getAccessoire() === $this) {
                $action->setAccessoire(null);
            }
        }

        return $this;
    }
}
