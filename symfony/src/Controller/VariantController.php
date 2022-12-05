<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Variant;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class VariantController extends AbstractController
{
    #[Route('/variant', name: 'app_variant')]
    public function variant(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $variant = new Variant();
        $variant->setIdArticle($request->toArray()['id_article']);
        $variant->setColor($request->toArray()['color']);
        $variant->setSize($request->toArray()['size']);
        $variant->setPrice($request->toArray()['price']);
        $variant->setSize($request->toArray()['size']);
        $variant->setWeight($request->toArray()['weight']);

        $entityManager->persist($variant);
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
