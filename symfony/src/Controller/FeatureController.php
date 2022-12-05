<?php

namespace App\Controller;

use App\Entity\Feature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class FeatureController extends AbstractController
{
    #[Route('/feature', name: 'app_feature')]
    public function feature(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $feature = new Feature();
        $feature->setIdArticle($request->toArray()['id_article']);
        $feature->setName($request->toArray()['name']);
        $feature->setContent($request->toArray()['content']);

        $entityManager->persist($feature);
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
