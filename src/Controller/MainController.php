<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/",
     *     name="homepage",
     *     methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('frontend/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
