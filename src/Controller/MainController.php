<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/", name="app_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="hompage")
     */
    public function hompage(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'Homepage',
        ]);
    }

    /**
     * @Route("/exemple", name="exemple")
     */
    public function exemple(): Response
    {
        return $this->render('main/exemple.html.twig', [
            'controller_name' => 'Exemple',
        ]);
    }

}
