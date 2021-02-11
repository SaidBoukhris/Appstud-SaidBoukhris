<?php

namespace App\Controller;

use App\Entity\Adverts;
use App\Form\Adverts1Type;
use App\Form\EditAccountType;
use App\Repository\AdvertsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/users", name="users_")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="user_account")
     */
    public function userAccount(): Response
    {   
        return $this->render('users/account/user.html.twig', [
            'controller_name' => ' Mon compte'
        ]);
    }

    /**
     * @Route("/account/edit", name="user_account_edit")
     */
    public function editUserAccount(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditAccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $this->addFlash('success','Votre profil à bien été mis à jour ');
            return $this->redirectToRoute('users_user_account');
        }

        return $this->render('users/account/user_account_edit.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Modifier mon profil'
        ]);
    }

    /**
     * @Route("/password/edit", name="user_password_edit")
     */
    public function editUserPassword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncode): Response
    {
        if ($request->isMethod('POST')) {
            $user = $this->getUser();  
            if ($request->request->get('password') == $request->request->get('confirmPassword')) { 
                $user->setPassword($passwordEncode->encodePassword($user,$request->get('password')));  
                $em->persist($user);
                $em->flush();
                $this->addFlash('success','Votre mot de passe a été mis à jour avec succés');
                return $this->redirectToRoute('users_user_account');
            }else{
                $this->addFlash('error','Les mots de passe doivent être identiques');
            }
        }

        return $this->render('users/account/user_password_edit.html.twig', [
            'controller_name' => 'Modifier mon mot de passe'
        ]);
    }

    /**
     * @Route("/adverts", name="adverts_all")
     */
    public function allAdverts(AdvertsRepository $adverts): Response
    {
        return $this->render('users/adverts/all.html.twig', [
            'controller_name' => 'Mes annonces',
            'adverts' => $adverts->findAll()
        ]);
    }

    /**
     * @Route("/adverts/{slug}", name="adverts_show", methods={"GET"})
     */
    public function showAdverts($slug,AdvertsRepository $repos): Response
    {
        return $this->render('users/adverts/show.html.twig', [
            'controller_name' => str_replace("-", " ", $slug),
            'advert' => $repos->findOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("/adverts/{slug}/edit", name="adverts_edit", methods={"GET","POST"})
     * @Route("/adverts/add", name="adverts_add", methods={"GET","POST"})
     */
    public function advertsForm(Adverts $advert=null, Request $request, EntityManagerInterface $em): Response
    {
        if(!$advert){
            $advert = new Adverts();
        }
        $form = $this->createForm(Adverts1Type::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advert->setUser($this->getUser());
            $advert->setActive(false);
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('users_adverts_show', ['slug' => $advert->getSlug()]);
        }

        return $this->render('users/adverts/form.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'Ajouter une annonce'
        ]);
    }
}
