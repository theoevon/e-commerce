<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
class Feature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $id = null;
    
    #[ORM\Column(length: 50)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $name = null;
    
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $value = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $type = null;
    
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?bool $is_sortable = null;
    
    #[ORM\ManyToOne(inversedBy: 'feature')]
    private ?Variant $variant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getVariant(): ?int
    // {
    //     return $this->variant;
    // }

    // public function setVariant(int $variant): self
    // {
    //     $this->variant = $variant;

    //     return $this;
    // }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
    
    public function setIsSortable(bool $is_sortable): self
    {
        $this->is_sortable = $is_sortable;

        return $this;
    }

    public function getIsSortable(): ?string
    {
        return $this->is_sortable;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    // public function getVariant(): ?Variant
    // {
    //     return $this->variant;
    // }

    // public function setVariant(?Variant $variant): self
    // {
    //     $this->variant = $variant;

    //     return $this;
    // }
}
