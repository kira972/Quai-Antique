<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PictureRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('name')]
#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFavorite = null;

    #[ORM\Column]
    private ?bool $isShowingInGallery = null;

    #[ORM\OneToOne(mappedBy: 'picture', cascade: ['persist', 'remove'])]
    private ?Product $product = null;

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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function isIsFavorite(): ?bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(?bool $isFavorite): self
    {
        $this->isFavorite = $isFavorite;

        return $this;
    }

    public function isIsShowingInGallery(): ?bool
    {
        return $this->isShowingInGallery;
    }

    public function setIsShowingInGallery(bool $isShowingInGallery): self
    {
        $this->isShowingInGallery = $isShowingInGallery;

        return $this;
    }

    public function __toString()
    {
    return $this->name;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        // unset the owning side of the relation if necessary
        if ($product === null && $this->product !== null) {
            $this->product->setPicture(null);
        }

        // set the owning side of the relation if necessary
        if ($product !== null && $product->getPicture() !== $this) {
            $product->setPicture($this);
        }

        $this->product = $product;

        return $this;
    }
}
