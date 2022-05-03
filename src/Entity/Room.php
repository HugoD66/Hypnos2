<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    #[ORM\Column(type: 'text')]
    private $descirption;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $pictures;

    #[ORM\Column(type: 'string', length: 255)]
    private $lienbooking;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescirption(): ?string
    {
        return $this->descirption;
    }

    public function setDescirption(string $descirption): self
    {
        $this->descirption = $descirption;

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

    public function getPictures(): ?string
    {
        return $this->pictures;
    }

    public function setPictures(string $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getLienbooking(): ?string
    {
        return $this->lienbooking;
    }

    public function setLienbooking(string $lienbooking): self
    {
        $this->lienbooking = $lienbooking;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

}
