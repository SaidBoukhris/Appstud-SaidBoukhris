<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/categories/add", name="categories_add")
     */
    public function addCategories(Request $request): Response
    {
        $categorie = new Categories();

        $form = $this->createForm(CategoriesType::class,$categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/categories/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Ajouter une catégorie'
        ]);
    }
}
