<?php

namespace App\Entity;

use App\Repository\ArticlesalesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesalesRepository::class)]
class Articlesales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articlesales')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'articlesales')]
    private ?Sales $sales = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSale(): ?int
    {
        return $this->id_sale;
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

    public function getSales(): ?Sales
    {
        return $this->sales;
    }

    public function setSales(?Sales $sales): self
    {
        $this->sales = $sales;

        return $this;
    }
}
