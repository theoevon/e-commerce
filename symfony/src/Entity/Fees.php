<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FeesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: FeesRepository::class)]
#[ApiResource]
// #[Post(security: "is_granted('ROLE_ADMIN')")]
// #[GetCollection]
// #[Get]
// #[Put(security: "is_granted('ROLE_ADMIN')")]
// #[Delete(security: "is_granted('ROLE_ADMIN')")]
class Fees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $base = null;

    #[ORM\Column]
    private ?int $weightFactor = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function setBase(int $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getWeightFactor(): ?int
    {
        return $this->weightFactor;
    }

    public function setWeightFactor(int $weightFactor): self
    {
        $this->weightFactor = $weightFactor;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
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
