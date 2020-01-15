<?php

namespace App\Controller;

use Model\Entity\Model;
use Model\Form\MarketerModelType;
use Model\Manager\ModelManager;
use Model\Repository\NewModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    public function index(Request $request, NewModelRepository $repository, ModelManager $manager)
    {
        /**
         * @var Model $model
         */
        $model = $repository->find(11);

        $form = $this->createForm(MarketerModelType::class, $model);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            dump($form->getData());
            exit;
            $manager->update($form->getData());
        }

        return $this->render('test/index.twig', [
            'form' => $form->createView()
        ]);
    }
}
