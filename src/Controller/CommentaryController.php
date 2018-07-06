<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\ExpressionLanguage\Expression;

class CommentaryController extends Controller
{
    /**
     * @Route("/newCommentary")
     */
    public function formulaireCommentaire(Request $request)
    {
        $commentaire = new Commentary();
        $commentaire->setPublishDate(new \Datetime());
        $commentaire->setAuteur($this->getUser());

        $form = $this->createForm(CommentType::class, $commentaire);
        $form->handleRequest($request);
        // Si le form est valide j'envoie les données en base.
        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route ("Commentary/{id}/edit", name="commentary_edit", methods="GET|POST")
     */
    // Création d'une méthode de l'objet commentaryController
    // -> je recupère mon objet de type "Commentary" et ma requête de type "Request"
    public function editCommentary(Request $request, Commentary $nthCommentary)
    {
        $this->denyAccessUnlessGranted(new Expression(
            'object.getAuteur() == user'), $nthCommentary);

        // Je créer mon formulaire sur le commentaire "$nthCommentary"
        // -> je recupère mon objet de type "Commentary" et ma requête de type "Request"
        $form = $this->createForm(CommentType::class, $nthCommentary);
        $form->handleRequest($request);

        // Je vérifie que mon formulaire est bien envoyée et qu'il a été validé
        // Requête doctrine -> envoie en base de donnée (flush)
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // Les données ont bien étés envoyées, je redirige sur la page du bars/{id}
            return $this->redirectToRoute('bars_show', ['id' => $nthCommentary->getBar()->getId()]);
        }

        // Ici je demande a retourner d'afficher le template "edit"
        return $this->render('commentary/edit.html.twig', array(
                // J'affecte la valeur de la variable $commentary a 'commentary'
                'commentary' => $nthCommentary,
                // Je créer une vue du formulaire.
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
