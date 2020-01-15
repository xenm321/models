<?php

namespace App\Controller\Api;

use App\Repository\DirectionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DirectionController
 * @package App\Controller\Api
 */
class DirectionController extends Controller
{
    /**
     * @Route("/api/direction/list", methods={"GET"})
     *
     * @param DirectionRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(DirectionRepository $repository)
    {
        $shops = $repository->findAll();

        return $this->json($shops, Response::HTTP_OK, [], ['groups' => ['frontend']]);
    }
}
