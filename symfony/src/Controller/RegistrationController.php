<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Security\EmailVerifier;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationController extends AbstractController
{

    // private EmailVerifier $emailVerifier;


    #[Route('/register', name: 'app_registration')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $arr = [];

        preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $request->request->get('email'), $match_email);
        preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $request->request->get('password'), $match_password);

        // if (count($match_email) == 0) {
        //     return new Response('Email invalide');
        // }
        // if (count($match_password) == 0) {
        //     return new Response('Password invalide');
        // }

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $request->toArray()['password']
        );

        $user->setEmail($request->toArray()['email']);
        $user->setPassword($hashedPassword);
        $user->setPseudo($request->toArray()['pseudo']);
        $user->setCreateAt(date("Y-m-d"));
        $user->setRoles(['ROLS_USER']);
        $entityManager->persist($user);
        try {
            $entityManager->flush();
        }
        catch (Exception $e) {
            $occurence =  strpos($e->getMessage() , 'Duplicate');
            if($occurence != false) {
                $arr["status"] = "error";
                $arr["message"] = "Un utilisateur avec cet adresse mail existe déjà";
                $arr_json = json_encode($arr);
                return new Response($arr_json); 
            }
        }

        $arr["status"] = "success";
        $arr_json = json_encode($arr);
        return new Response($arr_json);
    }

    /**
     * @Route("/verify", name="app_verify_email")
     */
    // public function verifyUserEmail(): Response
    // {

    // }
}
