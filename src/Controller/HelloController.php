<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class HelloController extends Controller
{
    /**
<<<<<<< HEAD
     * @Route("/hello/{name}", defaults={"name"="World"})
=======
     * @Route("/{name}", name="HomePage", defaults={"name"="homePage"})
>>>>>>> master
     */
    public function index($name)
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name
        ]);
    }
}
