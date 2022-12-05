<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articlesales;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ArticlesalesController extends AbstractController
{
    #[Route('/articlesales', name: 'app_articlesales')]
    public function articlesales(request $request, EntityManagerInterface $EntityManager): Response
    {
        $arr = [];

        $articlesales = new Articlesales();
        $articlesales->setIdSale($request->toArray()['id_sale']);
        $articlesales->setIdArticle($request->toArray()['id_article']);
        $EntityManager->persist($articlesales);
        try {
            $EntityManager->flush();
        }
        catch(Exception $e) {
            $arr['status'] = "error";
            $arr['message'] = "Champs non remplis ou type de donnée non valide";
        }

        $arr["status"] = "success";
        $arr_json = json_encode($arr);
        
        return new Response($arr_json);
    }
}
