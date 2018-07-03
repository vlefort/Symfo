<?php
namespace App\Controller;

use App\Form\AccountLoginType;
use App\Entity\Utilisateurs;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class ConnexionController extends Controller
{
    /**
     * @Route("/login", name="login")
     */

    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $erreur = $authenticationUtils->getLastAuthenticationError();
        $dernierUser = $authenticationUtils->getLastUsername();

        $Utilisateurs = new Utilisateurs();
        $form = $this->createForm(AccountLoginType::class, $Utilisateurs);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('replace_with_some_route');
        }


        return $this->render(
            'login/login.html.twig',array(
                'form' => $form->createView(),
                'dernier_user' => $dernierUser,
                'erreur' => $erreur,
                )
        );
    }
}