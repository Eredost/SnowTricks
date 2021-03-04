<?php


namespace App\Controller\Frontend;


use App\Entity\TrickVideo;
use App\Form\NewTrickVideoType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param TrickVideo $trickVideo
     * @param Request    $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(TrickVideo $trickVideo, Request $request)
    {
        $editTrickVideoForm = $this->createForm(NewTrickVideoType::class, $trickVideo);
        $editTrickVideoForm->handleRequest($request);

        if ($editTrickVideoForm->isSubmitted() && $editTrickVideoForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $this->addFlash('success', 'La vidéo a été modifiée avec succès !');

            return $this->redirectToRoute('trick_show', ['slug' => $trickVideo->getTrick()->getSlug()]);
        }

        return $this->render('frontend/trick-video-edit.html.twig', [
            'trickVideo'         => $trickVideo,
            'editTrickVideoForm' => $editTrickVideoForm->createView(),
        ]);
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
    public function delete(TrickVideo $trickVideo, Request $request, EntityManagerInterface $manager): RedirectResponse
    {
        if ($this->isCsrfTokenValid('trick-video-delete', $request->request->get('_csrf_token'))) {
            $manager->remove($trickVideo);
            $manager->flush();

            $this->addFlash('success', 'La vidéo a été supprimée avec succès !');
        }

        return $this->redirectToRoute('trick_show', ['slug' => $trickVideo->getTrick()->getSlug()]);
    }
}
