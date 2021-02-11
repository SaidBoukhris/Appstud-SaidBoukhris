<?php

namespace App\Controller;

use App\Repository\AdvertsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/", name="main_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="hompage")
     */
    public function hompage(AdvertsRepository $advertRepo): Response
    {
        return $this->render('main/adverts/advertAll.html.twig', [
            'controller_name' => 'Accueil',
            'adverts' => $advertRepo->findBy([],['createdAt'=> 'DESC']),
        ]);
    }

    /**
     * @Route("/categories", name="categories_all")
     */
    public function index(CategoriesRepository $categoriesRepos): Response
    {
        return $this->render('main/categories/categoriesAll.html.twig', [
            'controller_name' => 'Nos categories',
            'categories' => $categoriesRepos->findAll()
        ]);
    }

    /**
     * @Route("/adverts", name="adverts_all")
     */
    public function allAdverts(AdvertsRepository $advertRepos): Response
    {
        return $this->render('main/adverts/advertAll.html.twig', [
            'controller_name' => 'Annonces',
            'adverts' => $advertRepos->findAll()
        ]);
    }

    /**
     * @Route("/adverts/{slug}", name="adverts_show", methods={"GET"})
     */
    public function showAdverts($slug, AdvertsRepository $repos): Response
    {
        return $this->render('main/adverts/advertShow.html.twig', [
            'controller_name' => str_replace("-", " ", $slug),
            'advert' => $repos->findOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("/categories/{slug}", name="categories_show", methods={"GET"})
     */
    public function showCategories($slug, CategoriesRepository $repos): Response
    {
        return $this->render('main/categories/categoriesShow.html.twig', [
            'controller_name' => str_replace("-", " ", $slug),
            'categories' => $repos->findOneBy(['slug' => $slug])
        ]);
    }
    
}
