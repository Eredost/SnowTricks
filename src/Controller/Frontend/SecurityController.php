<?php

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Form\NewPasswordType;
use App\Form\RegistrationType;
use App\Form\UserType;
use App\Repository\UserRepository;
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
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Mailer $mailer
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
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
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/ask-reset",
     *     name="app_ask-reset",
     *     methods={"GET", "POST"})
     *
     * @param Request                $request
     * @param UserRepository         $repository
     * @param Mailer                 $mailer
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function askReset(Request $request, UserRepository $repository, Mailer $mailer, EntityManagerInterface $manager)
    {
        $userForm = $this->createForm(UserType::class);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $username = $userForm->getData()['username'];
            $user = $repository->findOneBy(['username' => $username]);

            $user->generateToken();
            $manager->flush();
            $mailer->passwordReset($user);

            $this->addFlash('success', 'Un email contenant un lien de réinitialisation de mot de passe a été envoyé à l\'adresse email associée à ce nom d\'utilisateur');

            return $this->redirectToRoute('app_ask-reset');
        }

        return $this->render('security/ask-reset.html.twig', [
            'userForm' => $userForm->createView(),
        ]);
    }

    /**
     * @Route("/reset-password",
     *     name="app_reset-password",
     *     methods={"GET", "POST"})
     *
     * @param Request                $request
     * @param UserRepository         $repository
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function resetPassword(Request $request, UserRepository $repository, EntityManagerInterface $manager)
    {
        $token = $request->query->get('token');
        $email = $request->query->get('email');

        $user = $repository->findOneBy(['email' => $email]);
        if ($user === null
            || !$user->getIsValidated()
            || !$user->validateToken($token)) {
            $this->addFlash('warning', 'Une erreur est survenue lors de la réinitialisation du mot de passe, si le problème persiste, veuillez contacter l\'administrateur du site');

            return $this->redirectToRoute('homepage');
        }

        $newPasswordForm = $this->createForm(NewPasswordType::class, $user);
        $newPasswordForm->handleRequest($request);

        if ($newPasswordForm->isSubmitted() && $newPasswordForm->isValid()) {
            $user->setToken(null);
            $manager->flush();

            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('security/reset-password.html.twig', [
            'newPasswordForm' => $newPasswordForm->createView(),
        ]);
    }
}
