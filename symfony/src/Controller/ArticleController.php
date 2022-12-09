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
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
    // #[Route('/')]
    // public function articles(ManagerRegistry $doctrine, Request $request): Response
    // {
    //     $articles = $doctrine->getRepository(Article::class)->fetchArticles();

    //     return new Response(json_encode($articles));
    // }

    #[Route('/addArtcle', name: 'app_article')]
    public function article(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $arr = [];
        $article = new Article();

        $file = "./file.json";
        $file = file_get_contents($file);
        $data = json_decode($file);
        foreach ($data as $key_1 => $val_1) {
            $dataCategory = $categoryRepository->findOneBy(['name' => $val_1->category]);
            $article->setCategory($dataCategory);
            $article->setName($key_1);
            $article->setPrix($val_1->prix);
            $article->setDescription($val_1->caracteristique);
            $article->setPublishDate(date("Y-m-d"));
            $entityManager->persist($article);
            $entityManager->flush();
            $entityManager->clear(Article::class);
        }
        // $article = new Article();
        // $article->setName($request->toArray()['name']);
        // $article->setDescription($request->toArray()['description']);
        // $article->setPrix($request->toArray()['prix']);
        // $article->setStock($request->toArray()['stock']);
        // $article->setIdCategory($request->toArray()['id_categorie']);
        // $article->setIdSubcategory($request->toArray()['id_subCategory']);
        // $article->setPublishDate(date("Y-m-d"));
        // $article->setVariants($request->toArray()['variants']);

        // $entityManager->persist($article);
        // try {
        //     $entityManager->flush();
        // } catch (Exception $e) {

        //     $arr["status"] = "error";
        //     $arr["message"] = "Champs non remplis ou type de donnée non valide ";
        //     $arr_json = json_encode($arr);
        //     return new Response($arr_json);
        // }

        // $arr["status"] = "success";
        // $arr_json = json_encode($arr);

        return new Response('');
    }

    #[Route('/showArticle/{id?}', name: 'app_article_api')]
    public function article_api($id, ArticleRepository $articles): Response
    {
        $arr = [];
        $arr_api = [];
        if ($id != null) {
            $valueArticle = $articles->find($id);
            $arr['name'] = $valueArticle->getName();
            $arr['description'] = $valueArticle->getDescription();
            $arr['prix'] = $valueArticle->getPrix();
            $arr['publish_date'] = $valueArticle->getPublishDate();
            $arr['category'] = $valueArticle->getCategory()->getName();
            $arr_api[$valueArticle->getId()] = $arr;
        } else {
            $data = $articles->findAll();
            foreach ($data as $valueArticle) {
                $arr['name'] = $valueArticle->getName();
                $arr['description'] = $valueArticle->getDescription();
                $arr['prix'] = $valueArticle->getPrix();
                $arr['publish_date'] = $valueArticle->getPublishDate();
                $arr['category'] = $valueArticle->getCategory()->getName();
                $arr_api[$valueArticle->getId()] = $arr;
            }
        }
        $response = new JsonResponse($arr_api);
        return $response;
    }
}
