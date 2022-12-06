<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\HttpFoundation\Request;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/')]
    public function articles(ManagerRegistry $doctrine, Request $request): Response
    {
        $articles = $doctrine->getRepository(Article::class)->fetchArticles();
        
        return new Response(json_encode($article));
    }

    #[Route('/add', name: 'app_article')]
    public function article(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $article = new Article();
        $article->setName($request->toArray()['name']);
        $article->setDescription($request->toArray()['description']);
        $article->setPrix($request->toArray()['prix']);
        $article->setStock($request->toArray()['stock']);
        $article->setIdCategory($request->toArray()['id_categorie']);
        $article->setIdSubcategory($request->toArray()['id_subCategory']);
        $article->setPublishDate(date("Y-m-d"));
        $article->setVariants($request->toArray()['variants']);

        $entityManager->persist($article);
        try {
            $entityManager->flush();
        } catch (Exception $e) {

            $arr["status"] = "error";
            $arr["message"] = "Champs non remplis ou type de donnée non valide ";
            $arr_json = json_encode($arr);
            return new Response($arr_json);
        }

        $arr["status"] = "success";
        $arr_json = json_encode($arr);

        return new Response($arr_json);
    }

}
