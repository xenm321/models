<?php

namespace App\Controller\Api;

use App\Repository\SupplierRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SupplierController
 * @package App\Controller\Api
 */
class SupplierController extends Controller
{
    /**
     * @Route("/api/supplier/list", methods={"GET"})
     *
     * @param SupplierRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(SupplierRepository $repository)
    {
        $shops = $repository->findAll();

        return $this->json($shops, Response::HTTP_OK, [], ['groups' => ['frontend']]);
    }
}
