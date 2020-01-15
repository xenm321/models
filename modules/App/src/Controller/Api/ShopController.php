<?php

namespace App\Controller\Api;

use App\Repository\ShopRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ShopController
 * @package App\Controller\Api
 */
class ShopController extends Controller
{
    /**
     * @Route("/api/shop/list", methods={"GET"})
     *
     * @param ShopRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(ShopRepository $repository)
    {
        $shops = $repository->findAll();

        return $this->json($shops, Response::HTTP_OK, [], ['groups' => ['frontend', 'shopList']]);
    }
}
