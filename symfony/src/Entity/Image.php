<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_variant = null;

    #[ORM\Column(length: 255)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVariant(): ?int
    {
        return $this->id_variant;
    }

    public function setIdVariant(int $id_variant): self
    {
        $this->id_variant = $id_variant;

        return $this;
    }

    public function getCle(): ?string
    {
        return $this->uuid;
    }

    public function setCle(string $uuid): self
    {
        $this->uuid = $uuid;

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
}
