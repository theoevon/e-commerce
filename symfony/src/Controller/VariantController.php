<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Variant;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use App\Entity\Article;

class VariantController extends AbstractController
{
    #[Route('/addVariant', name: 'app_variant')]
    public function variant(Request $request, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response
    {
        //request[/addVariant] => color , size , price , weight , name , article_name

        $variant = new Variant();
        $variant->setColor($request->toArray()['color']);
        $variant->setSize($request->toArray()['size']);
        $variant->setPrice($request->toArray()['price']);
        $variant->setWeight($request->toArray()['weight']);
        $variant->setName($request->toArray()['name']);
        $valueArticle = $articleRepository->findOneBy(['name' => $request->toArray()['article_name']]);
        $variant->setArticle($valueArticle);
        $entityManager->persist($variant);
        try {
            $entityManager->flush();
        } catch (Exception $e) {
            $arrStatus["status"] = "error";
            $arrStatus["message"] = "Champs non remplis ou type de donnée non valide ";
            return new Response(json_encode($arrStatus));
        }

        $arr["status"] = "success";
        return new Response(json_encode($arr));
    }
}
