<?php


namespace App\Controller\Frontend;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\NewCommentType;
use App\Form\NewTrickType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/trick",
 *     name="trick_")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/new",
     *     name="new",
     *     methods={"GET", "POST"})
     */
    public function new(Request $request, SluggerInterface $slugger)
    {
        $trick = new Trick();
        $newTrickForm = $this->createForm(NewTrickType::class, $trick);
        $newTrickForm->handleRequest($request);

        if ($newTrickForm->isSubmitted() && $newTrickForm->isValid()) {

            if ($images = $newTrickForm->get('trickImages')->getData()) {
                foreach ($images as $image) {

                    /** @var UploadedFile $imageFile */
                    $imageFile = $image->getFile();

                    if ($imageFile) {
                        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid('', true).'.'.$imageFile->guessExtension();

                        $imageFile->move(
                            $this->getParameter('trick_images_directory'),
                            $newFilename
                        );
                        $image->setSrc($newFilename);
                    }
                }
            }

            $trick->setUser($this->getUser());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render('frontend/trick-add.html.twig', [
            'newTrickForm' => $newTrickForm->createView(),
        ]);
    }

    /**
     * @Route("/{slug}",
     *     name="show",
     *     methods={"GET", "POST"})
     *
     * @param string            $slug
     * @param TrickRepository   $trickRepository
     * @param CommentRepository $commentRepository
     * @param Request           $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function show(string $slug, TrickRepository $trickRepository, CommentRepository $commentRepository, Request $request)
    {
        if (!$trick = $trickRepository->getTrickWithCategoryAndMedias($slug)) {
            throw new NotFoundHttpException('Cette figure n\'existe pas');
        }
        $commentsCount = $commentRepository->countComments($trick);

        $comment = new Comment();
        $newCommentForm = $this->createForm(NewCommentType::class, $comment);
        $newCommentForm->handleRequest($request);

        if ($newCommentForm->isSubmitted() && $newCommentForm->isValid()) {
            $comment->setUser($this->getUser())
                ->setTrick($trick)
            ;
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash('success', 'Votre commentaire a été ajouté avec succès');

            return $this->redirectToRoute('trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render('frontend/trick-show.html.twig', [
            'trick'          => $trick,
            'newCommentForm' => $newCommentForm->createView(),
            'commentsCount'  => $commentsCount,
        ]);
    }
}
