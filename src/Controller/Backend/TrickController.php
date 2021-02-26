<?php


namespace App\Controller\Backend;


use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/tricks",
 *     name="api_tricks_")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/",
     *     name="list",
     *     methods={"GET"})
     *
     * @param Request         $request
     * @param TrickRepository $trickRepository
     *
     * @return Response
     */
    public function list(Request $request, TrickRepository $trickRepository): Response
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 15);

        if (filter_var($page, FILTER_VALIDATE_INT) === false
            || filter_var($limit, FILTER_VALIDATE_INT) === false) {
            return $this->json(['message' => 'The url parameters provided must be integers'], 400);
        }

        $tricks = $trickRepository->findBy([], ['createdAt' => 'DESC'], $limit, ($page - 1) * $limit);

        return $this->json($tricks, 200, [], [
            'groups' => 'list_tricks',
        ]);
    }

    /**
     * @Route("/{trickId}/comments",
     *     name="comments",
     *     requirements={"trickId": "\d+"},
     *     methods={"GET"})
     *
     * @param int               $trickId
     * @param Request           $request
     * @param CommentRepository $commentRepository
     * @param TrickRepository   $trickRepository
     *
     * @return Response
     */
    public function listComments(int $trickId, Request $request, CommentRepository $commentRepository, TrickRepository $trickRepository): Response
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 5);

        if (filter_var($page, FILTER_VALIDATE_INT) === false
            || filter_var($limit, FILTER_VALIDATE_INT) === false) {
            return $this->json(['message' => 'The url parameters provided must be integers'], 400);
        }

        if (!$trickRepository->find($trickId)) {
            return $this->json(['message' => 'The desired trick does not exist'], 404);
        }

        $comments = $commentRepository->findBy(['trick' => $trickId], ['createdAt' => 'DESC'], $limit, ($page - 1) * $limit);

        return $this->json($comments, 200, [], [
            'groups' => 'list_comments',
        ]);
    }
}
