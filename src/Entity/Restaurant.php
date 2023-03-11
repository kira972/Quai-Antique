<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $address = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\Column(length: 180)]
    private ?string $mail = null;

    #[ORM\Column(length: 10)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 5)]
    private ?string $postCode = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: OpeningTime::class)]
    private Collection $openingTimeRest;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->openingTimeRest = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRestaurant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRestaurant() === $this) {
                $reservation->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OpeningTime>
     */
    public function getOpeningTimeRest(): Collection
    {
        return $this->openingTimeRest;
    }

    public function addOpeningTimeRest(OpeningTime $openingTimeRest): self
    {
        if (!$this->openingTimeRest->contains($openingTimeRest)) {
            $this->openingTimeRest->add($openingTimeRest);
            $openingTimeRest->setRestaurant($this);
        }

        return $this;
    }

    public function removeOpeningTimeRest(OpeningTime $openingTimeRest): self
    {
        if ($this->openingTimeRest->removeElement($openingTimeRest)) {
            // set the owning side to null (unless already changed)
            if ($openingTimeRest->getRestaurant() === $this) {
                $openingTimeRest->setRestaurant(null);
            }
        }

        return $this;
    }
}
