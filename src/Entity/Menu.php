<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('name')]
#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: Formule::class, orphanRemoval: true)]
    private Collection $formule;

    #[ORM\Column]
    private ?float $price = null;

    public function __construct()
    {
        $this->formule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Formule>
     */
    public function getFormule(): Collection
    {
        return $this->formule;
    }

    public function addFormule(Formule $formule): self
    {
        if (!$this->formule->contains($formule)) {
            $this->formule->add($formule);
            $formule->setMenu($this);
        }

        return $this;
    }

    public function removeFormule(Formule $formule): self
    {
        if ($this->formule->removeElement($formule)) {
            // set the owning side to null (unless already changed)
            if ($formule->getMenu() === $this) {
                $formule->setMenu(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
