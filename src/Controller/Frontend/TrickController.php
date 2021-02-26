<?php


namespace App\Controller\Frontend;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\NewCommentType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show($slug, TrickRepository $trickRepository, CommentRepository $commentRepository, Request $request)
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
