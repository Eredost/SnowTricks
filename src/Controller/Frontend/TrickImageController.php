<?php


namespace App\Controller\Frontend;


use App\Entity\TrickImage;
use App\Form\NewTrickImageType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trick-image",
 *     name="trick-image_")
 */
class TrickImageController extends AbstractController
{
    /**
     * @Route("/{id}/edit",
     *     name="edit",
     *     requirements={"id": "\d+"},
     *     methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @param TrickImage   $trickImage
     * @param Request      $request
     * @param FileUploader $uploader
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(TrickImage $trickImage, Request $request, FileUploader $uploader)
    {
        $editTrickImageForm = $this->createForm(NewTrickImageType::class, $trickImage);
        $editTrickImageForm->handleRequest($request);

        if ($editTrickImageForm->isSubmitted() && $editTrickImageForm->isValid()) {
            if ($imageFile = $trickImage->getFile()) {
                $newFilename = $uploader->upload($imageFile, $this->getParameter('trick_images_directory'));
                $trickImage->setSrc($newFilename);

                $manager = $this->getDoctrine()->getManager();
                $manager->flush();

                $this->addFlash('success', 'L\'image a été modifiée avec succès !');
            }

            return $this->redirectToRoute('trick_show', ['slug' => $trickImage->getTrick()->getSlug()]);
        }

        return $this->render('frontend/trick-image-edit.html.twig', [
            'trickImage'         => $trickImage,
            'editTrickImageForm' => $editTrickImageForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}",
     *     name="delete",
     *     requirements={"id": "\d+"},
     *     methods={"DELETE"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @param TrickImage             $trickImage
     * @param Request                $request
     * @param EntityManagerInterface $manager
     *
     * @return RedirectResponse
     */
    public function delete(TrickImage $trickImage, Request $request, EntityManagerInterface $manager): RedirectResponse
    {
        if ($this->isCsrfTokenValid('trick-image-delete', $request->request->get('_csrf_token'))) {
            $manager->remove($trickImage);
            $manager->flush();

            $this->addFlash('success', 'L\'image a été retirée avec succès !');
        }

        return $this->redirectToRoute('trick_show', ['slug' => $trickImage->getTrick()->getSlug()]);
    }
}
