<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }







}
