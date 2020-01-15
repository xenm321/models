<?php

namespace Model\Controller\Api;

use Model\Entity\Dictionary\Type;
use Model\Entity\TypePurchaseConfig;
use Model\Manager\TypePurchaseConfigManager;
use Model\Repository\TypePurchaseConfigRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TypePurchaseConfigController
 * @package Model\Controller\Api
 */
class TypePurchaseConfigController extends Controller
{
    /**
     * @Route("/api/type-purchase-config/{id}", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @param Type $type
     * @return JsonResponse
     */
    public function find(Type $type)
    {
        return $this->json($type, Response::HTTP_OK, [], ['groups' => ['frontend']]);
    }

    /**
     * @Route("/api/type-purchase-config", methods={"GET"})
     *
     * @param Request $request
     * @param TypePurchaseConfigRepository $repository
     *
     * @return JsonResponse
     */
    public function index(Request $request, TypePurchaseConfigRepository $repository)
    {
        $page = $request->query->getInt('page', 1);
        $sortBy = $request->query->get('sortBy', 'id');
        $descending = $request->query->getBoolean('descending', false);
        $perPage = $request->query->getInt('perPage', 10);
        $filters = $request->query->get('f', []);

        $pagination = $repository->fetchAll($page, $sortBy, $descending, $perPage, $filters);

        return $this->json([
            'items' => $pagination->getItems(),
            'total' => $pagination->getTotalItemCount(),
        ], Response::HTTP_OK, [], ['groups' => ['frontend']]);
    }

    /**
     * @Route("/api/-purchase-config/{id}", methods={"PUT"})
     *
     * @param TypePurchaseConfig $config
     * @param Request $request
     * @param TypePurchaseConfigManager $manager
     *
     * @return JsonResponse
     */
    public function update(TypePurchaseConfig $config, Request $request, TypePurchaseConfigManager $manager)
    {
        $post = $request->request->all();

        try {
            $manager->update($post, $config);

            return $this->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
                'errors' => $manager->getConstraintErrors(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
