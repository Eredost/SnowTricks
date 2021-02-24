<?php


namespace App\Controller\Frontend;


use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trick",
 *     name="trick_")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/{slug}",
     *     name="show",
     *     methods={"GET", "POST"})
     */
    public function show($slug, TrickRepository $repository)
    {
        if (!$trick = $repository->getTrickWithCategoryAndMedias($slug)) {
            throw new NotFoundHttpException('Cette figure n\'existe pas');
        }

        return $this->render('frontend/trick-show.html.twig', [
            'trick' => $trick,
        ]);
    }
}
