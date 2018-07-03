<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    /**
     * @Route("/hello/{name}", defaults={"name"="World"})
     */
    public function index($name)
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name
        ]);
    }
}
