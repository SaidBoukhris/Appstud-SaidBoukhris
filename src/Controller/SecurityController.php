<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->getUser()) {
            return $this->redirectToRoute('users_user_account');
            $this->addFlash('info','Déjà connecté');
        }
        
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error) {
            $this->addFlash('error','Mauvais identifiants de connexion');
        }
        return $this->render('security/login.html.twig', [
            'controller_name' => 'Login',
            'last_username' => $lastUsername
            ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(){}
}
