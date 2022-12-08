<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    public function category(request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $category = new Category();
        $category->setName($request->toArray()['name']);
        $entityManager->persist($category);
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

    #[Route('/showCategory', name: 'app_category_api')]
    function showCategory(CategoryRepository $category):Response
    {
        $data = $category->findAll();
        $arr_api = [];
        foreach($data as $value) {
            $arr_api[$value->getId()] = $value->getName();
        }
        $arr_json = json_encode($arr_api);
        return new Response($arr_json);
    }
}
