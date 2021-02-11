<?php

namespace App\Controller\Admin;

use App\Entity\Adverts;
use App\Form\Adverts1Type;
use App\Repository\AdvertsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/adverts", name="admin_adverts_")
 */
class AdvertsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdvertsRepository $repos): Response
    {
        return $this->render('admin/adverts/index.html.twig', [
            'controller_name' => 'Gérer les annonces',
            'adverts' => $repos->findAll()
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @Route("/{id<[0-9]+>}/edit", name="edit", methods={"GET","POST"})
     */
    public function addAdverts(Request $request, Adverts $advert=null, EntityManagerInterface $em): Response
    {
        if(!$advert){
            $advert = new Adverts();
        }

        $form = $this->createForm(Adverts1Type::class,$advert);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($advert);
            $em->flush();
            $this->addFlash('success', 'La catégorie a bien été ajouté');
            return $this->redirectToRoute('admin_adverts_home');
        }

        return $this->render('admin/adverts/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Ajouter une annonce'
        ]);
    }

    /**
    * @Route("/actived/{id<[0-9]+>}", name="actived")
    */
    public function activedAdverts(Adverts $advert, EntityManagerInterface $em): Response 
    {
        $advert->setActive(($advert->getActive())?false:true);
        $em->persist($advert);
        $em->flush();

        return new Response('TRUE');
    }

    /**
    * @Route("/delete/{id<[0-9]+>}", name="delete")
    */
    public function deleteAdverts(Adverts $advert, EntityManagerInterface $em): Response 
    {
        $em->remove($advert);
        $em->flush();
        
        $this->addFlash('success', 'Votre annonce a bien été supprimer');

        return $this->redirectToRoute('admin_adverts_home');
    }
}
