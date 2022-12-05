<?php

namespace App\Controller;

use App\Entity\SubCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;


class SubcategoryController extends AbstractController
{
    #[Route('/subcategory', name: 'app_subcategory')]
    public function subcategory(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $subcategory = new SubCategory();
        $subcategory->setIdParentCategory($request->toArray()['id_parent_category']);
        $subcategory->setName($request->toArray()['name']);

        $entityManager->persist($subcategory);
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
