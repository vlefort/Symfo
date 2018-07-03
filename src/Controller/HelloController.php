<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class HelloController extends Controller
{
    /**
     * @Route("/", defaults={"name"="World"})
     */
    public function index($name)
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name
        ]);
    }
}
