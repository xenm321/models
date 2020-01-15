<?php

namespace Model\Manager;

use App\Entity\Direction;
use App\Manager\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Model\Entity\Dictionary\Type;
use Model\Entity\TypePurchaseConfig;
use Model\Exception\ConfigurationException;
use Model\Model\PurchaseConfig\PurchaseConfigInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TypeManager.
 */
class TypeManager extends AbstractManager
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
     * @param array $data
     * @return Type
     */
    public function create(array $data): Type
    {
        /** @var Type $type */
        $type = $this->serializer->deserialize(json_encode($data), Type::class, 'json');
        $type->setCreated(new \DateTime());

        $this->validateEntity($type);

        $this->entityManager->beginTransaction();

        try {
            $this->storeEntity($type);
            $this->createPurchaseConfigs($type);
            $this->entityManager->commit();
        } catch (\Throwable $e) {
            $this->entityManager->rollback();
            throw $e;
        }

        return $type;
    }

    /**
     * Сохранение конфигураций для рассчёта закупочной цены для нового типа
     * @param Type $type
     */
    protected function createPurchaseConfigs(Type $type)
    {
        $directions = $this->entityManager->getRepository(Direction::class)->findAll();
        foreach ($directions as $direction) {
            $config = new TypePurchaseConfig();
            $config->setType($type)
                   ->setDirection($direction)
                   ->setConfig($this->getConfigObject($direction)->toArray());

            $this->storeEntity($config);
        }
    }

    /**
     * @param Direction $direction
     * @return PurchaseConfigInterface
     */
    protected function getConfigObject(Direction $direction): PurchaseConfigInterface
    {
        $class = '\\Model\\Model\\PurchaseConfig\\' . ucfirst($direction->getCode()) . 'PurchaseConfig';

        if (!class_exists($class)) {
            throw new ConfigurationException(sprintf(
                'Конфигурация для для рассчёта закупочной цены для направления "%s" не найдена!',
                $direction->getTitle()
            ));
        }

        return new $class();
    }

    /**
     * @param array $data
     * @param Type $existBrand
     */
    public function update(array $data, Type $existBrand)
    {
        /** @var Type $type */
        $type = $this->serializer->deserialize(json_encode($data), Type::class, 'json', [
            'object_to_populate' => $existBrand
        ]);
        $type->setUpdated(new \DateTime());

        $this->validateEntity($type);

        $this->storeEntity($type);
    }

    /**
     * @param Type $type
     */
    public function delete(Type $type)
    {
        $this->removeEntity($type);
    }
}
