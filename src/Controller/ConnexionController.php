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

    $error = $authenticationUtils->getLastAuthenticationError();

    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('login/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
    }
}