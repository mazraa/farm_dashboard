<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{   
    public function __construct()
    {

    }
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {   
        if (isset($_SESSION['userlogin']) && !empty($_SESSION['userlogin'])) {
            return $this->redirect('/');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        session_destroy();
        return $this->redirect('/login');
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function login_check() {
        // this controller will not be executed,
        // as the route is handled by the Security system
        throw new \Exception('Which means that this Exception will not be raised anytime soon …');
    }
}
