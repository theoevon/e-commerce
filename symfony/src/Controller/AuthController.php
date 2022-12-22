<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Exception;

class AuthController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $arr = [];

        $pseudo = $request->get('pseudo');
        $password = $request->get('password');
        $email = $request->get('email');

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $request->toArray()['password']
        );
        $user->setPassword($hashedPassword);
        $user->setEmail($request->toArray()['email']);
        $user->setPseudo($request->toArray()['pseudo']);
        $user->setRoles([]);
        $user->setCreateAt(date("Y-m-d"));
        $this->em->persist($user);
        try {
            $this->em->flush();
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

    #[Route('/auth', name: 'login', methods: ["POST"])]
    public function login(UserInterface $user, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
    }
}
