<?php

namespace App\Controller;

use App\Entity\Bars;
use App\Entity\Commentary;
use App\Form\BarsType;
use App\Form\CommentType;
use App\Repository\BarsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\ExpressionLanguage\Expression;

/**
 * @Route("/bars")
 */
class BarsController extends Controller
{
    /**
     * @Route("/", name="bars_index", methods="GET")
     */
    public function index(BarsRepository $barsRepository): Response
    {
        return $this->render('bars/index.html.twig', ['bars' => $barsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="bars_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $bar = new Bars();
        $form = $this->createForm(BarsType::class, $bar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $bar->setUser($this->getUser());
            $em->persist($bar);
            $em->flush();
            return $this->redirectToRoute('bars_index');
        }

        return $this->render('bars/new.html.twig', [
            'bar' => $bar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bars_show", methods="GET|POST")
     */
    public function show(Request $request, Bars $bar): Response
    {
        $commentaire = new Commentary();
        $commentaire->setPublishDate(new \Datetime());
        $commentaire->setAuteur($this->getUser());

        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);
        // Si le form est valide j'envoie les données en base.
        if($form->isSubmitted() && $form->isValid())
        {
            $commentaire->setBar($bar);

            $repositoryCommentary = $this->getDoctrine()->getManager();
            // Je sauvegarde toutes les données
            $repositoryCommentary->persist($commentaire);
            // J'envoie les données en base (INSERT INTO...)
            $repositoryCommentary->flush();
        }


        return $this->render('bars/show.html.twig', ['bar' => $bar, 'form'=> $form->createView()]);
    }

    /**
     * @Route("/{id}/edit", name="bars_edit", methods="GET|POST")

     */
    public function edit(Request $request, Bars $bar): Response
    {
        $this->denyAccessUnlessGranted(new Expression(
        'object.getUser() == user'), $bar);

        $form = $this->createForm(BarsType::class, $bar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bars_edit', ['id' => $bar->getId()]);
        }
         return $this->render('bars/edit.html.twig', [
            'bar' => $bar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bars_delete", methods="DELETE")
     */
    public function delete(Request $request, Bars $bar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bar->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bar);
            $em->flush();
        }

        return $this->redirectToRoute('bars_index');
    }
}
