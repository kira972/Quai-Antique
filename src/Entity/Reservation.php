<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTimeInterface $hour = null;

    #[ORM\Column]
    private ?int $numberCover = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToMany(targetEntity: Allergie::class, mappedBy: 'reservation')]
    private Collection $allergieReserv;

    public function __construct()
    {
        $this->allergieReserv = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getNumberCover(): ?int
    {
        return $this->numberCover;
    }

    public function setNumberCover(int $numberCover): self
    {
        $this->numberCover = $numberCover;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection<int, Allergie>
     */
    public function getAllergieReserv(): Collection
    {
        return $this->allergieReserv;
    }

    public function addAllergieReserv(?Allergie $allergieReserv): self
    {
        if (!$this->allergieReserv->contains($allergieReserv)) {
            $this->allergieReserv->add($allergieReserv);
            $allergieReserv->addReservation($this);
        }

        return $this;
    }

    public function removeAllergieReserv(Allergie $allergieReserv): self
    {
        if ($this->allergieReserv->removeElement($allergieReserv)) {
            $allergieReserv->removeReservation($this);
        }

        return $this;
    }
}
