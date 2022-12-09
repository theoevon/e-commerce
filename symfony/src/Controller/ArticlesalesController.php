<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articlesales;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use App\Repository\ArticleRepository;
use App\Entity\Sales;
use App\Repository\ArticlesalesRepository;

class ArticlesalesController extends AbstractController
{
    #[Route('/addArticleSales', name: 'app_articlesales')]
    public function articleSales(request $request, EntityManagerInterface $EntityManager, ArticleRepository $articleRepository): Response
    {
        //request => name , promotion
        $articlesales = new Articlesales();
        $valueArticle = $articleRepository->findOneBy(['name' => $request->toArray()['name']]);
        $articlesales->setArticle($valueArticle);
        $sales = new Sales();
        $sales->setPromotion($request->toArray()['promotion']);
        $articlesales->setSales($sales);
        $EntityManager->persist($articlesales);
        $EntityManager->persist($sales);
        try {
            $EntityManager->flush();
        } catch (Exception $e) {
            $arr['status'] = "error";
            $arr['message'] = "Champs non remplis ou type de donnée non valide";
            return new Response(json_encode($arr));
        }

        $arr["status"] = "success";
        return new Response(json_encode($arr));
    }


    #[Route('/showArticleSales/{id?}', name: 'app_articlesales_api')]
    public function showArticleSales($id, ArticlesalesRepository $articlesalesRepository): Response
    {
        if ($id != null) {
            $valueArticleSales = $articlesalesRepository->find($id);
            $arr['article'] = $valueArticleSales->getArticle()->getName();
            $arr['promotion'] = $valueArticleSales->getSales()->getPromotion();
            $arr_api[$id] = $arr;
        } else {
            $data = $articlesalesRepository->findAll();
            foreach ($data as $valueArticleSales) {
                $arr['article'] = $valueArticleSales->getArticle()->getName();
                $arr['promotion'] = $valueArticleSales->getSales()->getPromotion();
                $arr_api[$valueArticleSales->getId()] = $arr;
            }
        }
        return new Response(json_encode($arr_api));
    }
}
