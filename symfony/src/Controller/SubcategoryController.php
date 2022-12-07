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
    #[Route('/subcategory', name: 'app_subcategory')]
    public function subcategory(Request $request, EntityManagerInterface $doctrine, CategoryRepository $categoryRepository): Response
    {
        $subcategory = new SubCategory();
        $subcategory->setName($request->toArray()['name']);

        $data = $categoryRepository->findOneBy(['name' => $request->toArray()['category']]);

        $subcategory->setCategory($data);

        $doctrine->persist($subcategory);
        $doctrine->flush();

        return new Response();
    }

    #[Route('/showSubCategory', name: 'app_showSubcategory_api')]
    public function showSubcategory(SubCategoryRepository $subCategoryRepository): Response
    {
        $data = $subCategoryRepository->findOneBy(['name' => 'annilator_R2']);
        var_dump($data);
        return new Response('coucou');
    }
}
