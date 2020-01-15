<?php

namespace Model\Controller\Api;

use Model\Entity\Dictionary\Type;
use Model\Manager\BrandManager;
use Model\Manager\TypeManager;
use Model\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TypeController.
 */
class TypeController extends Controller
{
    /**
     * @Route("/api/type/{id}", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @param Type $type
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function find(Type $type)
    {
        return $this->json($type, Response::HTTP_OK, [], ['groups' => ['frontend', 'typesList']]);
    }

    /**
     * @Route("/api/type/list", methods={"GET"})
     *
     * @param TypeRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(TypeRepository $repository)
    {
        $types = $repository->findAll();

        return $this->json($types, Response::HTTP_OK, [], ['groups' => ['frontend', 'brandsList']]);
    }

    /**
     * @Route("/api/type", methods={"GET"})
     *
     * @param Request        $request
     * @param TypeRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, TypeRepository $repository)
    {
        $page = $request->query->getInt('page', 1);
        $sortBy = $request->query->get('sortBy', 'id');
        $descending = $request->query->getBoolean('descending', false);
        $perPage = $request->query->getInt('perPage', 10);
        $search = $request->query->get('search', '');

        $pagination = $repository->fetchAll($page, $sortBy, $descending, $perPage, $search);

        return $this->json([
            'items' => $pagination->getItems(),
            'total' => $pagination->getTotalItemCount(),
        ], Response::HTTP_OK, [], ['groups' => ['frontend', 'typesList']]);
    }

    /**
     * @Route("/api/type", methods={"POST"})
     *
     * @param Request     $request
     * @param TypeManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request, TypeManager $manager)
    {
        $post = $request->request->all();

        try {
            $brand = $manager->create($post);

            return $this->json([
                'item' => $brand,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/type/{id}", methods={"PUT"})
     *
     * @param Type        $type
     * @param Request     $request
     * @param TypeManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Type $type, Request $request, TypeManager $manager)
    {
        $post = $request->request->all();

        try {
            $manager->update($post, $type);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/type/{id}", methods={"DELETE"})
     *
     * @param Type         $type
     * @param TypeManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Type $type, TypeManager $manager)
    {
        try {
            $manager->delete($type);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
