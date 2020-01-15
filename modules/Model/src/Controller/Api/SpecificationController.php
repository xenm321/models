<?php

namespace Model\Controller\Api;

use Model\Repository\SpecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecificationController extends AbstractController
{
    /**
     * @Route("/api/specification", methods={"GET"})
     *
     * @param Request         $request
     * @param SpecificationRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, SpecificationRepository $repository)
    {
        $filters = $request->query->get('f', []);
        $search = $request->query->get('search', '');

        $items = $repository->fetchAll($search, $filters);

        return $this->json([
            'items' => $items
        ], Response::HTTP_OK, [], ['groups' => ['frontend', 'brandsList']]);
    }
}
