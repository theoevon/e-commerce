<?php

namespace App\Controller;

use App\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;


class CommandController extends AbstractController
{
    #[Route('/command', name: 'app_command')]
    public function command(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arr = [];

        $command = new Command();
        $command->setIdUser($request->toArray()['id_user']);
        $command->setDate(date("Y-m-d"));
        $command->setPrice($request->toArray()['price']);
        $command->setAddress($request->toArray()['address']);
        $command->setToken($request->toArray()['token']);
        $command->setIsgift($request->toArray()['id_gift']);

        $entityManager->persist($command);
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

        return new Response('');
    }
}
