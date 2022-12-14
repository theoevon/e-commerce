<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
 
class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(#[CurrentUser] ?UserInterface $user): Response
    {
        
        if (null === $user) {
            return $this->json([
                'status' => 'error',
                'message' => 'Utilisateur inconue',
            ]);
        }
        session_start();
        $_SESSION['user_email'] = $user->getEmail(); 
        $_SESSION['user_pseudo'] = $user->getPseudo(); 
        return $this->json([
            'status'  => 'success' ,
            'name' => $user->getPseudo(),
            'email' => $user->getEmail()
        ]);
    }
}
