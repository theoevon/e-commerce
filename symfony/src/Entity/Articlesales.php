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

    #[ORM\Column]
    private ?int $id_sale = null;

    #[ORM\Column]
    private ?int $id_article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSale(): ?int
    {
        return $this->id_sale;
    }

    public function setIdSale(int $id_sale): self
    {
        $this->id_sale = $id_sale;

        return $this;
    }

    public function getIdArticle(): ?int
    {
        return $this->id_article;
    }

    public function setIdArticle(int $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }
}
