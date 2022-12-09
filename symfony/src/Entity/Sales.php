<?php

namespace App\Entity;

use App\Repository\SalesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesRepository::class)]
class Sales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $promotion = null;

    #[ORM\OneToMany(mappedBy: 'sales', targetEntity: Articlesales::class)]
    private Collection $articlesales;

    public function __construct()
    {
        $this->articlesales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromotion(): ?int
    {
        return $this->promotion;
    }

    public function setPromotion(int $promotion): self
    {
        $this->promotion = $promotion;

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
            $articlesale->setSales($this);
        }

        return $this;
    }

    public function removeArticlesale(Articlesales $articlesale): self
    {
        if ($this->articlesales->removeElement($articlesale)) {
            // set the owning side to null (unless already changed)
            if ($articlesale->getSales() === $this) {
                $articlesale->setSales(null);
            }
        }

        return $this;
    }
}
