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

class ArticleController extends AbstractController
{
    // #[Route('/')]
    // public function articles(ManagerRegistry $doctrine, Request $request): Response
    // {
    //     $articles = $doctrine->getRepository(Article::class)->fetchArticles();

    //     return new Response(json_encode($articles));
    // }

    #[Route('/addArticle/{file?}', name: 'app_article')]
    public function article($file, Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository): Response
    {
        //request => prix , description , category , name , subcategory , 
        //variant => {color , size , price , weight , name , image => {filename , uuid}}

        $article = new Article();
        $variant = new Variant();
        $image = new Image();
        if ($file == "file") {
            $file = "./file.json";
            $file = file_get_contents($file);
            $data = json_decode($file);
            foreach ($data as $key_1 => $val_1) {
                $dataCategory = $categoryRepository->findOneBy(['name' => $val_1->category]);
                $dataSubCategory = $subCategoryRepository->findOneBy(['name' => $val_1->subCategory]);
                $article->setCategory($dataCategory);
                $article->setSubCategory($dataSubCategory);
                $article->setName($key_1);
                $article->setPrix($val_1->prix);
                $article->setDescription($val_1->caracteristique);
                $article->setPublishDate(date("Y-m-d"));
                if (isset($val_1->variant)) {
                    $this->articleVariant($val_1->variant, $variant, $image, "file");
                    $article->addVariant($variant);
                    $entityManager->persist($variant);
                    $entityManager->persist($image);
                }
                $entityManager->persist($article);
                try {
                    $entityManager->flush();
                } catch (Exception $e) {
                    $arr["status"] = "error";
                    $arr["message"] = "Champs non remplis ou type de donnée non valide ";
                    $arr_json = json_encode($arr);
                    return new Response($e);
                }
                $entityManager->clear(Article::class);
                $entityManager->clear(Variant::class);
                $entityManager->clear(Image::class);
            }
        } else {
            $dataCategory = $categoryRepository->findOneBy(['name' => $request->toArray()['category']]);
            $dataSubCategory = $categoryRepository->findOneBy(['name' => $request->toArray()['subCategory']]);
            $article->setCategory($dataCategory);
            $article->setSubCategory($dataSubCategory);
            $article->setName($request->toArray()['name']);
            $article->setPrix($request->toArray()['prix']);
            $article->setDescription($request->toArray()['description']);
            $article->setPublishDate(date("Y-m-d"));
            if(isset($request->toArray()['variant'])) {
                $this->articleVariant($request->toArray()['variant'], $variant, $image, "request");
                $article->addVariant($variant);
                $entityManager->persist($variant);
                $entityManager->persist($image);
            }
            $entityManager->persist($article);
            try {
                $entityManager->flush();
            } catch (Exception $e) {
                $arr["status"] = "error";
                $arr["message"] = "Champs non remplis ou type de donnée non valide ";
                $arr_json = json_encode($arr);
                return new Response($arr_json);
            }
            $entityManager->clear(Article::class);
            $entityManager->clear(Variant::class);
            $entityManager->clear(Image::class);
        }
        $arr["status"] = "success";
        return new Response(json_encode($arr));
    }

    public function articleVariant($valueVariant, $variant, $image,  $req)
    {
        if($req == "file") {
            $variant->setColor($valueVariant->color);
            $variant->setSize($valueVariant->size);
            $variant->setPrice($valueVariant->price);
            $variant->setWeight($valueVariant->weight);
            $variant->setName($valueVariant->name);
            $image->setCle($valueVariant->image->uuid);
            $image->setFilename($valueVariant->image->fileName);
            $variant->addImage($image);
        }
        else {
            $variant->setColor($valueVariant['color']);
            $variant->setSize($valueVariant['size']);
            $variant->setPrice($valueVariant['price']);
            $variant->setWeight($valueVariant['weight']);
            $variant->setName($valueVariant['name']);
            $image->setCle($valueVariant['image']['uuid']);
            $image->setCle($valueVariant['image']['fileName']);
            $variant->addImage($image);
        }
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
            $arr['prix'] = $valueArticle->getPrix();
            $arr['publish_date'] = $valueArticle->getPublishDate();
            $arr['category'] = $valueArticle->getCategory()->getName();
            $arr['subCategory'] = $valueArticle->getSubCategory()->getName();
            $valueVariant = $variantRepository->findOneBy(['article' => $valueArticle->getId()]);
            $valueImage = $imageRepository->findOneBy(['variant' =>$valueVariant->getId()]);
            $arr['image_url'] = $valueImage->getUuid();
            $arr['image_name'] = $valueImage->getFilename();
            $arr_api[$valueArticle->getId()] = $arr;
        } else {
            $data = $articles->findAll();
            foreach ($data as $valueArticle) {
                $arr['name'] = $valueArticle->getName();
                $arr['description'] = $valueArticle->getDescription();
                $arr['prix'] = $valueArticle->getPrix();
                $arr['publish_date'] = $valueArticle->getPublishDate();
                $arr['category'] = $valueArticle->getCategory()->getName();
                $arr['subCategory'] = $valueArticle->getSubCategory()->getName();
                $arr_api[$valueArticle->getId()] = $arr;
            }
        }
        return new Response(json_encode($arr_api));
    }
}
