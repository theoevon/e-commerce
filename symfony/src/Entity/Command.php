<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['command:output']],
    denormalizationContext: ['groups' => ['command:input']],
)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['command:output', 'command:input'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['command:output', 'command:input'])]
    private ?int $id_user = null;

    #[ORM\Column(length: 255)]
    #[Groups(['command:output', 'command:input'])]
    private ?string $date = null;

    #[ORM\Column]
    #[Groups(['command:output', 'command:input'])]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['command:output', 'command:input'])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(['command:output', 'command:input'])]
    private ?string $token = null;

    #[ORM\Column]
    #[Groups(['command:output', 'command:input'])]
    private ?bool $isgift = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function isIsgift(): ?bool
    {
        return $this->isgift;
    }

    public function setIsgift(bool $isgift): self
    {
        $this->isgift = $isgift;

        return $this;
    }

    public function getIsgift(): ?string
    {
        return $this->isgift;
    }
}
