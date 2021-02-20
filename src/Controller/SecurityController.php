<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login",
     *     name="app_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/signup",
     *     name="app_signup")
     *
     * @param Request                $request
     * @param EntityManagerInterface $manager
     * @param Mailer                 $mailer
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function signup(Request $request, EntityManagerInterface $manager, Mailer $mailer)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $user = new User();
        $registrationForm = $this->createForm(RegistrationType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $user->generateToken();
            $mailer->signup($user);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte a été créé avec succès. Un email vous a été envoyé afin de valider votre adresse email.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('security/signup.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    /**
     * @Route("/logout",
     *     name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
