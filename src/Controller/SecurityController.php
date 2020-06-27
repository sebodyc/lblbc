<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login_token", name="login_token", methods={"POST"})
     *
     */
    public function login_token()
    {


    }

    /**
     * @Route("/" , name="security_login")
     * @param Security $security
     * @return Response
     */
    public function login(Security $security)
    {


        return $this->render('security/login.html.twig', []);
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('security_login');
    }







}
