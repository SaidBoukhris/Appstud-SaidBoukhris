<?php

namespace App\Controller;

use App\Repository\AdvertsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/", name="app_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="hompage")
     */
    public function hompage(AdvertsRepository $advertRepo): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'Accueil',
            'adverts' => $advertRepo->findBy([],['createdAt'=> 'DESC']),
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
