<?php

namespace App\Controller\Admin;

use App\Entity\Adverts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'ADMIN',
        ]);
    }

    /**
     * @Route("/advert/actived/{id<[0-9]+>}", name="advert_actived")
     */
    public function actived(Adverts $advert, EntityManagerInterface $em): Response
    {
        $advert->setActive(($advert->getActive())?false:true);
        $em->persist($advert);
        $em->flush();
        return new Response("true");
    }
}
