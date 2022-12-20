<?php

namespace App\Entity;

use App\Repository\ArticlesalesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticlesalesRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
class Articlesales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articlesales')]
    private ?Article $article = null;

    #[ORM\Column]
    #[Groups(['article:output', 'article:input'])]
    private ?int $promotion = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPromotion(): ?int
    {
        return $this->promotion;
    }

    public function setPromotion(int $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }
}
