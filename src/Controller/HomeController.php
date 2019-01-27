<?php
// src/Controller/HomeController.php
namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{   
	private $router;

	public function __construct()
    {

    }
    /**
    * @Route("/", name="app_home_index")
    */
    public function index()
    {			
    	
    	if (!isset($_SESSION['userlogin'])) {
    		return $this->redirect('/login');
    	}
        return $this->render('home.html.twig');
    }

}