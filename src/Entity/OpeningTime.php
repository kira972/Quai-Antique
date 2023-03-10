<?php

namespace App\Entity;

use App\Repository\OpeningTimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningTimeRepository::class)]
class OpeningTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchOpen = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $lunchClose = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinnerOpen = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $dinnerClose = null;

    #[ORM\Column(length: 11)]
    private ?string $dayOfWeek = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLunchOpen(): ?\DateTimeInterface
    {
        return $this->lunchOpen;
    }

    public function setLunchOpen(\DateTimeInterface $lunchOpen): self
    {
        $this->lunchOpen = $lunchOpen;

        return $this;
    }

    public function getLunchClose(): ?\DateTimeInterface
    {
        return $this->lunchClose;
    }

    public function setLunchClose(\DateTimeInterface $lunchClose): self
    {
        $this->lunchClose = $lunchClose;

        return $this;
    }

    public function getDinnerOpen(): ?\DateTimeInterface
    {
        return $this->dinnerOpen;
    }

    public function setDinnerOpen(\DateTimeInterface $dinnerOpen): self
    {
        $this->dinnerOpen = $dinnerOpen;

        return $this;
    }

    public function getDinnerClose(): ?\DateTimeInterface
    {
        return $this->dinnerClose;
    }

    public function setDinnerClose(\DateTimeInterface $dinnerClose): self
    {
        $this->dinnerClose = $dinnerClose;

        return $this;
    }

    public function getDayOfWeek(): ?string
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(string $dayOfWeek): self
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }
}
