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


    #[Route('/registration', name: 'app_registration')]
    public function register(Request $request , UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager ): Response
    {
        // $user = new User();
        // $user->setRoles(['ROLS_USER']);
        $arr = [];

        // preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $request->request->get('email'), $bool);

        // $hashedPassword = $passwordHasher->hashPassword(
        //     $user,
        //     $request->request->get('password')
        // );

        // $user->setEmail($request->request->get('email'));
        // $user->setPassword($hashedPassword);
        // $user->setRoles(['ROLS_USER']);
        // $entityManager->persist($user);

        $arr['email'] = "shany@blabla.com";
        $arr['password'] = "nanananana";
        $arr = json_encode($arr);
        return new Response($arr);
    }

     /**
     * @Route("/verify", name="app_verify_email")
     */
    // public function verifyUserEmail(): Response
    // {

    // }
}
