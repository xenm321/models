<?php

namespace Model\Manager;

use App\Manager\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Model\Entity\Model;
use Model\Entity\PurchasePrice;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ModelManager
 * @package Model\Manager
 */
class ModelManager extends AbstractManager
{
    /**
     * TypeManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     * @param SerializerInterface    $serializer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        parent::__construct($entityManager, $validator, $serializer);
    }

    /**
     * @param Model $model
     *
     * @return Model
     */
    public function create(Model $model): Model
    {
        $this->storeEntity($model);

        return $model;
    }

    /**
     * @param Model $model
     */
    public function update(Model $model)
    {
        $model->setUpdated(new \DateTime());

        $this->storeEntity($model);
    }

    /**
     * @param Model $type
     */
    public function delete(Model $type)
    {
        $this->removeEntity($type);
    }
}
