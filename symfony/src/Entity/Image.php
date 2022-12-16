<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $filename = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Variant $variant = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getVariant(): ?Variant
    {
        return $this->variant;
    }

    public function setVariant(?Variant $variant): self
    {
        $this->variant = $variant;

        return $this;
    }
}
