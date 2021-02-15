<?php


namespace App\Controller\Backend;


use App\Repository\TrickRepository;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api",
 *     name="api_")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/tricks",
     *     name="tricks_list",
     *     methods={"GET"})
     *
     * @param Request         $request
     * @param TrickRepository $trickRepository
     *
     * @return Response
     */
    public function list(Request $request, TrickRepository $trickRepository)
    {
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 15);

        if (filter_var($page, FILTER_VALIDATE_INT) === false
            || filter_var($limit, FILTER_VALIDATE_INT) === false) {
            throw new InvalidArgumentException('The url parameters provided must be integers');
        }

        $tricks = $trickRepository->findBy([], ['createdAt' => 'DESC'], $limit, ($page - 1) * $limit);

        return $this->json($tricks, 200, [], [
            'groups' => 'list_tricks',
        ]);
    }
}
