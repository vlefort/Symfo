<?php
namespace App\Controller;

use App\Form\AccountLoginType;
use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConnexionController extends Controller
{
    /**
     * @Route("/login", name="user_registration")
     */

    public function connexion(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $Utilisateurs = new Utilisateurs();
        $form = $this->createForm(AccountLoginType::class, $Utilisateurs);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            
            return $this->redirectToRoute('replace_with_some_route');
        }

        return $this->render(
            'login/login.html.twig',
            array('form' => $form->createView())
        );
    }
}