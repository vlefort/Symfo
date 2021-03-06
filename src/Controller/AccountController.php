<?php

namespace App\Controller;

use App\Form\AccountLoginType;
use App\Entity\Users;
use App\Form\UsersType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
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
     * @Route("/", name="account", methods="GET|POST")
     */
    public function index()
    {
        $usr= $this->getUser();
        return $this->render('account/index.html.twig',array(
            'usr'=>$usr
        ));
    }

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
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer)
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('pierre@beaa.fr')
                ->setTo('pierre2897@hotmail.fr')
                ->setBody(
                    $this->renderView(
                        'emails/registration.html.twig',
                        array('user' => $user)
                    ),
                    'text/html')
            ;
            $mailer->send($message);
            return $this->redirectToRoute('bars_index');
        }
        return $this->render('account/register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/addAdmin", name="adminnn", methods="GET|POST")
     */
    public function addadmin(Request $request)
    {
        $usr=$this->getUser();
        $array=$usr->getRoles();
        array_push($array,"ROLE_ADMIN");
        $usr->setRoles($array);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('logout');
    }

}