<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Image;
use App\Repository\ImageRepository;

class ImageController extends AbstractController
{
    #[Route('/image', name: 'app_image')]
    public function image(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $image = new Image();
        $image->setCle($request->toArray()['uuid']);
        $image->setFilename($request->toArray()['filename']);

        $entityManager->persist($image);
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
