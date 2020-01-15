<?php

namespace Model\Manager;

use App\Manager\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Model\Entity\TypePurchaseConfig;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class TypePurchaseConfigManager
 * @package Model\Manager
 */
class TypePurchaseConfigManager extends AbstractManager
{
    /**
     * TypePurchaseConfigManager constructor.
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
     * @param TypePurchaseConfig $existConfig
     */
    public function update(array $data, TypePurchaseConfig $existConfig)
    {
        /** @var TypePurchaseConfig $type */
        $config = $this->serializer->deserialize(json_encode($data), TypePurchaseConfig::class, 'json', [
            'object_to_populate' => $existConfig
        ]);
        $config->setUpdated(new \DateTime());

        $this->validateEntity($config);

        $this->storeEntity($config);
    }
}
