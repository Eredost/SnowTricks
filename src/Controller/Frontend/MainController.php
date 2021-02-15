<?php

namespace App\Controller\Frontend;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/",
     *     name="homepage",
     *     methods={"GET"})
     *
     * @param TrickRepository $trickRepository
     *
     * @return Response
     */
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('frontend/home.html.twig', [
            'tricksCount' => $trickRepository->countTricks(),
        ]);
    }
}
