<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/api/user/{id}", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function find(User $user)
    {
        return $this->json($user, Response::HTTP_OK, [], ['groups' => ['frontend', 'oneUser']]);
    }

    /**
     * @Route("/api/user/current", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getCurrentUser()
    {
        return $this->json($this->getUser(), Response::HTTP_OK, [], ['groups' => ['frontend', 'oneUser']]);
    }
}
