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
     * @Route("/{id}",
     *     name="show",
     *     requirements={"id" = "\d+"},
     *     methods={"GET", "POST"})
     */
    public function show($id, TrickRepository $repository)
    {
        if (!$trick = $repository->getTrickWithCategoryAndMedias($id)) {
            throw new NotFoundHttpException('Cette figure n\'existe pas');
        }

        return $this->render('frontend/trick-show.html.twig', [
            'trick' => $trick,
        ]);
    }
}
