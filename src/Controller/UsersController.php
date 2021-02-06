<?php

namespace App\Controller;

use App\Entity\Adverts;
use App\Entity\Users;
use App\Form\Adverts1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/users", name="users_")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="adverts_all")
     */
    public function allAdverts(): Response
    {
        $advert = $this->getDoctrine()->getRepository(Adverts::class)->findAll();
        return $this->render('users/adverts/all.html.twig', [
            'controller_name' => 'Mes annonces',
            'advert' => $advert
        ]);
    }

    /**
     * @Route("/adverts/add", name="adverts_add")
     */
    public function addAdverts(Request $request, EntityManagerInterface $em): Response
    {
        $advert = new Adverts();
        $form = $this->createForm(Adverts1Type::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advert->setUser($this->getUser());
            $advert->setActive(false);
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('users_adverts_show', ['slug' => $advert->getSlug()]);
        }

        return $this->render('users/adverts/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Ajouter une annonce'
        ]);
    }

    /**
     * @Route("/adverts/{slug}", name="adverts_show", methods={"GET"})
     */
    public function showAdverts($slug): Response
    {
        $advert = $this->getDoctrine()->getRepository(Adverts::class)->findOneBy(['slug' => $slug]);
        return $this->render('users/adverts/show.html.twig', [
            'controller_name' => $advert->getTitle(),
            'advert' => $advert
        ]);
    }
}
