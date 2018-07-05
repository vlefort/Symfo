<?php

namespace App\Controller;

use App\Entity\Bars;
use App\Entity\Evaluations;
use App\Form\BarsType;
use App\Repository\BarsRepository;
use App\Repository\EvaluationsRepository;
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
    public function new(Request $request, BarsRepository $barsRepository): Response
    {
        $bar = new Bars();
        $form = $this->createForm(BarsType::class, $bar);
        $form->handleRequest($request);
        $bars_already = false;
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $barsNom = $em->getRepository(Bars::class)->findByNom($bar->getNom());


            if(count($barsNom) > 0){
                $bars_already = true;
            }else{
               $bar->setUser($this->getUser());
                $em->persist($bar);
               $em->flush();
               return $this->redirectToRoute('bars_index');
            }
        }

        return $this->render('bars/new.html.twig', [
            'bar' => $bar,
            'form' => $form->createView(),
            'bars_already' => $bars_already,
        ]);
    }

    /**
     * @Route("/{id}", name="bars_show", methods="GET")
     */
    public function show(Bars $bar): Response
    {
        $repo = $this->getDoctrine()->getRepository(Evaluations::class);
        $eval_avg =$repo->findAllAverageEvaluation($bar);

        return $this->render('bars/show.html.twig', ['bar' => $bar, "avgEvaluations" => $eval_avg]);
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

/**
     * @Route("/recherche", name="recherche")
     */
    public function recherche(Request $request,BarsRepository $barsRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $bars_recherche = $em->getRepository(Bars::class)->findBarsWithKeyWord($request->get('mot_cle'));

        return $this->render('bars/index.html.twig', 
            ['bars' => $bars_recherche]);
    }

}
