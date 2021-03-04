<?php


namespace App\Controller\Frontend;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trick-video",
 *     name="trick-video_")
 */
class TrickVideoController extends AbstractController
{
    /**
     * @Route("/{id}/edit",
     *     name="edit",
     *     requirements={"id": "\d+"},
     *     methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit()
    {

    }

    /**
     * @Route("/{id}",
     *     name="delete",
     *     requirements={"id": "\d+"},
     *     methods={"DELETE"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @return RedirectResponse
     */
    public function delete(): RedirectResponse
    {

    }
}
