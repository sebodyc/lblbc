<?php

namespace App\Controller;

use App\Entity\AdminSearch;
use App\Entity\AdminSearchUser;
use App\Entity\User;
use App\Form\AdminSearchType;
use App\Form\AdminSearchUserType;
use App\Form\UserType;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("admin/console", name="admin_console")
     * @param UserRepository $user
     * @param ProductsRepository $productsRepository
     * @param Request $request
     * @return Response
     */
    public function index(UserRepository $user, ProductsRepository $productsRepository, Request $request)
    {

        $search = new AdminSearch();


        $form =$this->createForm(AdminSearchType::class,$search);
        $form->handleRequest($request);
        $users = $user->findAll();
        $products = $productsRepository->findAll();

        if($form->isSubmitted()){
            $users= $user->search($search->getFindByName());
        }

        if ($form->isSubmitted() && $form->isEmpty()){
            $users = $user->findAll();
        }

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'products' => $products,
            'form'=> $form->createView(),
        ]);
    }



    /**
     * @Route("admin/user/{id<\d+>}", name="user_show")
     * @param User $user
     * @return Response
     */
    public function user(User $user)
    {

        return $this->render('admin/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     *
     * @Route("/admin/edit/{id<\d+>}", name="user_edit")
     * @param User $user
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(User $user, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();
            return $this->redirectToRoute('admin_console', ['id' => $user->getId()]);
        }

        return $this->render("admin/editUser.html.twig", [
            "userForm" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete/user/{id<\d+>}", name="user_delete")
     * @param User $user
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function deleteUser(User $user, EntityManagerInterface $em)
    {
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('admin_console');
    }


    /**
     * @Route("admin/console/products" , name="admin_products")
     * @param ProductsRepository $productsRepository
     * @param UserRepository $userRepository
     * @param Request $request
     * @return Response
     */
    public function indexProducts(ProductsRepository $productsRepository, UserRepository $userRepository, Request $request ){
        $search = new AdminSearch();
        $form =$this->createForm(AdminSearchType::class,$search);
        $form->handleRequest($request);
        $products=$productsRepository->findAll();
        $users=$userRepository->findAll();


        if($form->isSubmitted()){
            $products= $productsRepository->search($search->getFindByName());
        }

        if ($form->isSubmitted() && $form->isEmpty()){
            $products=$productsRepository->findAll();
        }

        return $this->render('admin/indexProducts.html.twig',[
            'products'=>$products,
            'users'=>$users,
            'form'=>$form->createView(),
        ]);
    }
}
