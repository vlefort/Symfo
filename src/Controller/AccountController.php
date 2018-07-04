<?php

namespace App\Controller;

use App\Form\AccountLoginType;
use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/login", name="login", methods="GET|POST")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('account/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    /**
     * @Route("/register", name="register", methods="GET|POST")
     */
    public function register(Request $request)
    {
        $form = $this->createForm(UsersType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            return $this->redirectToRoute('task_success');
        }
        return $this->render('bars/edit.html.twig', [
            'bar' => $bar,
            'form' => $form->createView(),
        ]);
    }

}