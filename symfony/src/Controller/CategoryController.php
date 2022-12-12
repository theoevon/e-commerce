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
    #[Route('/addCategory', name: 'app_category')]
    public function category(request $request, EntityManagerInterface $entityManager): Response
    {
        //request => name
        $category = new Category();
        $category->setName($request->toArray()['name']);
        $entityManager->persist($category);
        try {
            $entityManager->flush();
        } catch (Exception $e) {
            $arrStatus["status"] = "error";
            $arrStatus["message"] = "Champs non remplis ou type de donnée non valide ";
            return new Response(json_encode($arrStatus));
        }
        $arrStatus["status"] = "success";
        return new Response(json_encode($arrStatus));
    }

    #[Route('/showCategory/{id?}', name: 'app_category_api')]
    function showCategory($id, CategoryRepository $category): Response
    {
        $arr_api = [];
        if ($id != null) {
            $valueCategory = $category->find($id);
            $arr_api[$valueCategory->getId()] = $valueCategory->getName();
        } else {
            $data = $category->findAll();
            foreach ($data as $valueCategory) {
                $arr_api[$valueCategory->getId()] = $valueCategory->getName();
            }
        }
        $arr_json = json_encode($arr_api);
        return new Response($arr_json);
    }
}
