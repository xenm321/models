<?php

namespace Model\Controller\Api;

use Model\Entity\Model;
use Model\Manager\ModelManager;
use Model\Repository\ModelRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModelController
 * @package Model\Controller\Api
 */
class ModelController extends Controller
{
    /**
     * @Route("/api/model", methods={"GET"})
     *
     * @param Request         $request
     * @param ModelRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, ModelRepository $repository)
    {
        $page = $request->query->getInt('page', 1);
        $sortBy = $request->query->get('sortBy', 'id');
        $descending = $request->query->getBoolean('descending', false);
        $perPage = $request->query->getInt('perPage', 10);
        $filters = $request->query->get('f', []);

        $status = Model::STATUS_ACTIVE;

        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */
        $pagination = $repository->fetchAll($page, $sortBy, $descending, $perPage, $status, $filters);

        return $this->json([
            'items' => $pagination->getItems(),
            'total' => $pagination->getTotalItemCount(),
        ], Response::HTTP_OK, [], ['groups' => ['frontend', 'modelsList']]);
    }

    /**
     * @Route("/api/model/{id}", methods={"PUT"})
     *
     * @param Model        $model
     * @param Request      $request
     * @param ModelManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Model $model, Request $request, ModelManager $manager)
    {
        $post = $request->request->all();

        try {
            $manager->update($post, $model);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/model/{id}", methods={"DELETE"})
     *
     * @param Model        $model
     * @param ModelManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Model $model, ModelManager $manager)
    {
        try {
            $manager->delete($model);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
