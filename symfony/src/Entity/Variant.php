<?php

namespace App\Entity;

use App\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VariantRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
class Variant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $color = null;

    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $size = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $price = null;

    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $weight = null;

    #[ORM\ManyToOne(inversedBy: 'variant')]
    private ?Article $article = null;

    #[Groups(['article:output', 'article:input'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['article:output', 'article:input'])]
    #[ORM\OneToMany(mappedBy: 'variant', targetEntity: Image::class)]
    private Collection $images;

    #[Groups(['article:output', 'article:input'])]
    #[ORM\OneToMany(mappedBy: 'variant', targetEntity: Feature::class)]
    private Collection $feature;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->feature = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection<int, Feature>
     */
    public function getFeature(): Collection
    {
        return $this->feature;
    }

    public function addFeature(Feature $feature): self
    {
        if (!$this->feature->contains($feature)) {
            $this->feature->add($feature);
            $feature->setVariant($this);
        }

        return $this;
    }

    public function removeFeature(Feature $feature): self
    {
        if ($this->feature->removeElement($feature)) {
            // set the owning side to null (unless already changed)
            if ($feature->getVariant() === $this) {
                $feature->setVariant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setVariant($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVariant() === $this) {
                $image->setVariant(null);
            }
        }

        return $this;
    }
}
