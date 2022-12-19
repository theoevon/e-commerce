<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use App\Entity\Variant;
use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Repository\VariantRepository;
use App\Entity\SubCategory;

class ArticleController extends AbstractController
{

    #[Route('/addArticle/{file?}', name: 'app_article')]
    public function article($file, Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository): Response
    {
        //request => prix , description , category , name , subcategory , 
        //variant => {color , size , price , weight , name , image => {filename , uuid}}

        $articleEntity = new Article();
        $variantEntity = new Variant();
        $imageEntity = new Image();
        if ($file == "file") {
            $file = "./file-ordinateur-portable.json";
            $file = file_get_contents($file);
            $data = json_decode($file);
            foreach ($data as $category => $categoryValue) {
                $this->articleCategory($category, $categoryValue, $articleEntity, $variantEntity, $imageEntity, $entityManager, $categoryRepository, $subCategoryRepository);
            }
        }
        $arr["status"] = "success";
        return new Response(json_encode($arr));
    }

    public function articleCategory($category, $categoryValue, $articleEntity, $variantEntity, $imageEntity, $entityManager, $categoryRepository, $subCategoryRepository)
    {
        foreach ($categoryValue as $name => $value) {
            $dataCategory = $categoryRepository->findOneBy(['name' => $category]);
            $articleEntity->setCategory($dataCategory);
            // if ($subCategoryRepository->findOneBy(['name' => $value->subCategory]) !== null) {
                $dataSubCategory = $subCategoryRepository->findOneBy(['name' => $value->subCategory]);
            // } else {
            //     $subCategory = new SubCategory();
            //     $subCategory->setName($value->subCategory);
            //     $dataSubCategory = $subCategory;
            //     $entityManager->persist($subCategory);
            // }
            $articleEntity->setSubCategory($dataSubCategory);
            $articleEntity->setName($name);
            $articleEntity->setDescription($value->caracteristique);
            $articleEntity->setPublishDate(date("Y-m-d"));
            $this->articleVariant($value->variant, $articleEntity, $variantEntity, $imageEntity, $entityManager, 'file');
            $entityManager->clear(Article::class);
        }
    }

    public function articleVariant($valueVariant, $articleEntity, $variantEntity, $imageEntity, $entityManager, $req)
    {
        if ($req == "file") {
            foreach ($valueVariant as $color => $value) {
                $variantEntity->setColor($color);
                $variantEntity->setSize($value->size);
                $variantEntity->setPrice($value->price);
                $variantEntity->setWeight($value->weight);
                $variantEntity->setName($value->name);
                $imageEntity->setCle($value->image->uuid);
                $imageEntity->setFilename($value->image->fileName);
                $variantEntity->addImage($imageEntity);
                $articleEntity->addVariant($variantEntity);
                $entityManager->persist($imageEntity);
                $entityManager->persist($variantEntity);
                $entityManager->persist($articleEntity);
                // dd($articleEntity);
                $entityManager->flush();
                $entityManager->clear(Variant::class);
                $entityManager->clear(Image::class);
                // $entityManager->clear(SubCategory::class);
            }
        }
        // else {
        //     $variant->setColor($valueVariant['color']);
        //     $variant->setSize($valueVariant['size']);
        //     $variant->setPrice($valueVariant['price']);
        //     $variant->setWeight($valueVariant['weight']);
        //     $variant->setName($valueVariant['name']);
        //     $image->setCle($valueVariant['image']['uuid']);
        //     $image->setCle($valueVariant['image']['fileName']);
        //     $variant->addImage($image);
        // }
    }


    #[Route('/showArticle/{id?}', name: 'app_article_api')]
    public function article_api($id, ArticleRepository $articles, ImageRepository $imageRepository, VariantRepository $variantRepository): Response
    {
        $arr = [];
        $arr_api = [];
        if ($id != null) {
            $valueArticle = $articles->find($id);
            $arr['name'] = $valueArticle->getName();
            $arr['description'] = $valueArticle->getDescription();
            $arr['publish_date'] = $valueArticle->getPublishDate();
            $arr['category'] = $valueArticle->getCategory()->getName();
            $arr['subCategory'] = $valueArticle->getSubCategory()->getName();
            $valueVariant = $variantRepository->findBy(['article' => $valueArticle->getId()]);
            foreach ($valueVariant as $value) {
                $valueImage = $imageRepository->findOneBy(['variant' => $value->getId()]);
                $arr_temporaire[$value->getColor()] = ['fileName' => $valueImage->getFilename(), 'url' => $valueImage->getUuid()];
                $arr['variant'] = $arr_temporaire;
            }
            array_push($arr_api, $arr);
        } else {
            $data = $articles->findAll();
            foreach ($data as $valueArticle) {
                $arr = [];
                $arr['name'] = $valueArticle->getName();
                $arr['description'] = $valueArticle->getDescription();
                $arr['publish_date'] = $valueArticle->getPublishDate();
                $arr['category'] = $valueArticle->getCategory()->getName();
                $arr['subCategory'] = $valueArticle->getSubCategory()->getName();
                $valueVariant = $variantRepository->findBy(['article' => $valueArticle->getId()]);
                $arr_temporaire = [];
                foreach ($valueVariant as $value) {
                    $valueImage = $imageRepository->findOneBy(['variant' => $value->getId()]);
                    $arr_temporaire[$value->getColor()] = ['fileName' => $valueImage->getFilename(), 'url' => $valueImage->getUuid()];
                    $arr['variant'] = $arr_temporaire;
                }
                array_push($arr_api, $arr);
            }
        }
        $response = new Response(json_encode($arr_api, JSON_PRETTY_PRINT));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
