<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $publish_date = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?SubCategory $subCategory = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Articlesales::class)]
    private Collection $articlesales;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Variant::class)]
    private Collection $variants;

    public function __construct()
    {
        $this->articlesales = new ArrayCollection();
        $this->variants = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
            $variant->setArticle($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getArticle() === $this) {
                $variant->setArticle(null);
            }
        }

        return $this;
    }
    
}
