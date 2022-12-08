<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SubCategory;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;

class SubcategoryController extends AbstractController
{
    #[Route('/addSubCategory', name: 'app_subcategory')]
    public function subcategory(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        //data request => name , category

        $subcategory = new SubCategory();
        $subcategory->setName($request->toArray()['name']);

        $data = $categoryRepository->findOneBy(['name' => $request->toArray()['category']]);

        $subcategory->setCategory($data);

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

    #[Route('/showSubCategory', name: 'app_showSubcategory_api')]
    public function showSubcategory(SubCategoryRepository $subCategoryRepository): Response
    {
        $data = $subCategoryRepository->findAll();
        $arr = [];
        $arr_api = [];
        foreach ($data as $value) {
            $arr['name'] = $value->getName();
            $arr['category'] = $value->getCategory()->getName();
            $arr_api[$value->getId()] = $arr;
        }

        $arr_json = json_encode($arr_api);

        return new Response($arr_json);
    }
}
