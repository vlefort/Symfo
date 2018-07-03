<?php

namespace App\Controller;

use App\Entity\Commentary;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function createFakeCommentary()
    {
        $comment = new Commentary();
        $comment->setMessage();
        $comment->setAuteur(2);
        $comment->setPublishDate(new \DateTime());

        $repository = $this->getDoctrine()->getManager();
        $repository->persist($comment);
        $repository->flush();

        return $this->render('test/index.html.twig', [
            'comments' => $comment
        ]);
    }

    /**
     * @Route("/liste")
     */
    public function listCommentary()
    {
        $repository = $this->getDoctrine()->getRepository(Commentary::class);
        //recuperer toutes les entrees de la table
        $comments = $repository->findAll();


        return $this->render('test/index.html.twig', [
            'comments' => $comments
        ]);
    }
}
