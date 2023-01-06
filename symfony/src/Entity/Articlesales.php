<?php

namespace App\Entity;

use App\Repository\ArticlesalesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: ArticlesalesRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:output']],
    denormalizationContext: ['groups' => ['article:input']],
)]
// #[Post(security: "is_granted('ROLE_ADMIN')")]
// #[GetCollection]
// #[Get]
// #[Put(security: "is_granted('ROLE_ADMIN')")]
// #[Delete(security: "is_granted('ROLE_ADMIN')")]
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
