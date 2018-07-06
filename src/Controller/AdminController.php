<?php

namespace App\Controller;

use App\Entity\Bars;
use App\Entity\Users;
use App\Form\UsersType;
use App\Entity\Evaluations;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_index", methods="GET")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Bars::class);
        $bar =$repo->findAll();

        return $this->render('bars/show.html.twig', ['bar' => $bar]);
    }

}