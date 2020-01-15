<?php

namespace Model\Controller\Api;

use Model\Entity\Dictionary\Brand;
use Model\Repository\BrandRepository;
use Model\Manager\BrandManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BrandController.
 */
class BrandController extends Controller
{
    /**
     * @Route("/api/brand/{id}", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @param Brand $brand
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function find(Brand $brand)
    {
        return $this->json($brand, Response::HTTP_OK, [], ['groups' => ['frontend', 'brandsList']]);
    }

    /**
     * @Route("/api/brand/list", methods={"GET"})
     *
     * @param BrandRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(BrandRepository $repository)
    {
        $brands = $repository->findAll();

        return $this->json($brands, Response::HTTP_OK, [], ['groups' => ['frontend', 'brandsList']]);
    }

    /**
     * @Route("/api/brand", methods={"GET"})
     *
     * @param Request         $request
     * @param BrandRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, BrandRepository $repository)
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
        ], Response::HTTP_OK, [], ['groups' => ['frontend', 'brandsList']]);
    }

    /**
     * @Route("/api/brand", methods={"POST"})
     *
     * @param Request      $request
     * @param BrandManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request, BrandManager $manager)
    {
        $post = $request->request->all();

        try {
            $brand = $manager->create($post);

            return $this->json($brand, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/brand/{id}", methods={"PUT"})
     *
     * @param Brand        $brand
     * @param Request      $request
     * @param BrandManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update(Brand $brand, Request $request, BrandManager $manager)
    {
        $post = $request->request->all();

        try {
            $manager->update($post, $brand);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/brand/{id}", methods={"DELETE"})
     *
     * @param Brand        $brand
     * @param BrandManager $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(Brand $brand, BrandManager $manager)
    {
        try {
            $manager->delete($brand);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
