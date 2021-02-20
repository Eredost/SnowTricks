<?php


namespace App\Controller\Frontend;


use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user",
 *     name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/validate",
     *     name="validation",
     *     methods={"GET"})
     *
     * @param Request                $request
     * @param UserRepository         $repository
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function accountValidation(Request $request, UserRepository $repository, EntityManagerInterface $manager)
    {
        $token = $request->query->get('token');
        $email = $request->query->get('email');

        $user = $repository->findOneBy(['email' => $email]);
        if ($user === null
            || $user->getIsValidated()
            || !$user->validateToken($token)) {
            $this->addFlash('warning', 'Une erreur est survenue lors de la validation, celui-ci a peut être expiré ou est invalide, il vous ait possible de générer un nouveau lien en vous tentant de vous connecter');

            return $this->redirectToRoute('homepage');
        }

        $user->setIsValidated(true)
            ->setToken('');
        $manager->flush();

        $this->addFlash('success', 'Votre compte a été validé avec succès, vous pouvez désormais vous connecter à votre compte');

        return $this->redirectToRoute('app_login');
    }
}
