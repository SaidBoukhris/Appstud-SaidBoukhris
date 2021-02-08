<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/categories", name="admin_categories_")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoriesRepository $repos): Response
    {
        return $this->render('admin/categories/index.html.twig', [
            'controller_name' => 'Gérer les categories',
            'categories' => $repos->findAll()
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @Route("/{id<[0-9]+>}/edit", name="edit", methods={"GET","POST"})
     */
    public function addCategories(Request $request, Categories $categorie=null): Response
    {
        if(!$categorie){
            $categorie = new Categories();
        }

        $form = $this->createForm(CategoriesType::class,$categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie a bien été ajouté');
            return $this->redirectToRoute('admin_categories_home');
        }

        return $this->render('admin/categories/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Ajouter une catégorie'
        ]);
    }


}
