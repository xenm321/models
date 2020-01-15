<?php

namespace Model\Controller\Api;

use App\Repository\SupplierRepository;
use App\Serializer\FormErrorSerializer;
use Model\Entity\Model;
use Model\Entity\ModelExt;
use Model\Entity\PurchasePrice;
use Model\Form\MarketerModelType;
use Model\Form\NewModelType;
use Model\Manager\ModelManager;
use Model\Repository\BrandRepository;
use Model\Repository\NewModelRepository;
use Model\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NewModelController
 * @package Model\Controller\Api
 */
class NewModelController extends Controller
{
    /**
     * @Route("/api/new-model", methods={"GET"})
     *
     * @param Request         $request
     * @param NewModelRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request, NewModelRepository $repository)
    {
        $page = $request->query->getInt('page', 1);
        $sortBy = $request->query->get('sortBy', 'id');
        $descending = $request->query->getBoolean('descending', false);
        $perPage = $request->query->getInt('perPage', 10);
        $filters = $request->query->get('f', []);

        $status = Model::STATUS_NEW;

        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */
        $pagination = $repository->fetchAll($page, $sortBy, $descending, $perPage, $status, $filters);

        return $this->json([
            'items' => $pagination->getItems(),
            'total' => $pagination->getTotalItemCount(),
        ], Response::HTTP_OK, [], ['groups' => ['frontend', 'modelsList']]);
    }

    /**
     * @Route("/api/new-model/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function find($id, NewModelRepository $repository)
    {
        $model = $repository->find($id);

        if(!$model) {
            return $this->json([
                'message' => 'Модель не найдена',
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($model, Response::HTTP_OK, [], ['groups' => ['model']]);
    }

    /**
     * @Route("/api/new-model", methods={"POST"})
     *
     * @param Request     $request
     * @param ModelManager $manager
     * @param FormErrorSerializer $formErrorSerializer
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request, ModelManager $manager, FormErrorSerializer $formErrorSerializer)
    {
        $data = array_merge_recursive($request->request->all(), $request->files->all());

        $form = $this->createForm(NewModelType::class);

        $form->submit($data);

        if(!$form->isValid()) {
            return $this->json([
                'errors' => $formErrorSerializer->convertFormToArray($form),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $model = $manager->create($form->getData());
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($model, Response::HTTP_CREATED, [], ['groups' => ['frontend', 'modelsList']]);
    }

    /**
     * @Route("/api/new-model/{id}", methods={"PATCH"})
     *
     * @param Request $request
     * @param NewModelRepository $repository
     * @param ModelManager $manager
     * @param FormErrorSerializer $formErrorSerializer
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function update($id, Request $request, NewModelRepository $repository, ModelManager $manager, FormErrorSerializer $formErrorSerializer)
    {
        /**
         * @var Model $model
         */
        $model = $repository->find($id);

        if(!$model) {
            return $this->json([
                'message' => 'Модель не найдена',
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $request->request->all();

        $form = $this->createForm(MarketerModelType::class, $model);

        $form->submit($data, false);

        if(!$form->isValid()) {
            return $this->json([
                'errors' => $formErrorSerializer->convertFormToArray($form),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $model = $manager->update($form->getData());
        } catch (\Exception $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($model, Response::HTTP_NO_CONTENT, [], ['groups' => ['frontend', 'modelsList']]);
    }
}
