<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
// #[Post(security: "is_granted('ROLE_ADMIN')")]
// #[GetCollection]
// #[Get]
// #[Put(security: "is_granted('ROLE_ADMIN')")]
// #[Delete(security: "is_granted('ROLE_ADMIN')")]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article:output', 'article:input'])]
    private ?string $publish_date = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[Groups(['article:output', 'article:input'])]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Articlesales::class)]
    #[Groups(['article:output', 'article:input'])]
    private Collection $articlesales;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Variant::class)]
    #[Groups(['article:output', 'article:input'])]
    private Collection $variant;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[Groups(['article:output', 'article:input'])]
    private ?SubCategory $subCategory = null;

    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $popularity = 0;

    public function __construct()
    {
        $this->articlesales = new ArrayCollection();
        $this->variant = new ArrayCollection();
    }
 
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

    public function getPublishDate(): ?string
    {
        return $this->publish_date;
    }

    public function setPublishDate(string $publish_date): self
    {
        $this->publish_date = $publish_date;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    } 
    
    /**
     * @return Collection<int, Articlesales>
     */
    public function getArticlesales(): Collection
    {
        return $this->articlesales;
    }

    public function addArticlesale(Articlesales $articlesale): self
    {
        if (!$this->articlesales->contains($articlesale)) {
            $this->articlesales->add($articlesale);
            $articlesale->setArticle($this);
        }

        return $this;
    }

    public function removeArticlesale(Articlesales $articlesale): self
    {
        if ($this->articlesales->removeElement($articlesale)) {
            // set the owning side to null (unless already changed)
            if ($articlesale->getArticle() === $this) {
                $articlesale->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Variant>
     */
    public function getVariant(): Collection
    {
        return $this->variant;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variant->contains($variant)) {
            $this->variant->add($variant);
            $variant->setArticle($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variant->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getArticle() === $this) {
                $variant->setArticle(null);
            }
        }

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

}
