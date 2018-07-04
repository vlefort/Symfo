<?php

namespace App\Controller;

use App\Entity\Commentary;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentaryController extends Controller
{
    /**
     * @Route("/newCommentary")
     */
    public function formulaireCommentaire(Request $request)
    {
        $commentaire = new Commentary();
        $commentaire->setPublishDate(new \Datetime());
        $commentaire->setAuteur($this->getUser()->getId());

        $form = $this->createFormBuilder($commentaire)
            ->add('Message', TextareaType::class, array(
                'label' => 'Message',
                'attr' => array(
                    'placeholder' => 'Donnez votre avis')))
            ->add('Publier', SubmitType::class, array('label' => 'Envoyer le commentaire'))
            ->getForm();

        $form->handleRequest($request);
        // Si le form est valide j'envoie les données en base.
        if($form->isSubmitted() && $form->isValid())
        {
            $repositoryCommentary = $this->getDoctrine()->getManager();
            // Je sauvegarde toutes les données
            $repositoryCommentary->persist($commentaire);
            // J'envoie les données en base (INSERT INTO...)
            $repositoryCommentary->flush();
        }

        return $this->render('commentary/new.html.twig', array(
            'form' => $form->createView()
            )
        );
    }


    /**
     * @Route("/liste")
     */
    public function listCommentary()
    {
        $repository = $this->getDoctrine()->getRepository(Commentary::class);
        //recuperer toutes les entrees de la table
        $comments = $repository->findAll();


        return $this->render('commentary/index.html.twig', [
            'comments' => $comments
        ]);
    }
}
