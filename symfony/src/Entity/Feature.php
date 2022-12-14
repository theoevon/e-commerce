<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
#[ApiResource]
class Feature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_variant = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $value = null;
    
    #[ORM\Column(length: 255)]
    private ?string $type = null;
    
    #[ORM\Column]
    private ?bool $is_sortable = null;

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
}
