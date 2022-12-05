<?php

namespace App\Controller;

use App\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class RatingController extends AbstractController
{
    #[Route('/rating', name: 'app_rating')]
    public function rating(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $rating = new Rating();
        $rating->setIdUser($request->toArray()['id_user']);
        $rating->setIdArticle($request->toArray()['id_article']);
        $rating->setNote($request->toArray()['note']);
        $rating->setIdUser($request->toArray()['id_user']);
        $rating->setComment($request->toArray()['comment']);
        $rating->setPublishDate(date("Y-m-d"));

        $entityManager->persist($rating);
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
