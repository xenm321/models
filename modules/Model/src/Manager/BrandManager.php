<?php

namespace Model\Manager;

use Model\Entity\Dictionary\Brand;
use App\Manager\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BrandManager.
 */
class BrandManager extends AbstractManager
{
    /**
     * BrandManager constructor.
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
     *
     * @return Brand
     */
    public function create(array $data): Brand
    {
        /** @var Brand $brand */
        $brand = $this->serializer->deserialize(json_encode($data), Brand::class, 'json');
        $brand->setCreated(new \DateTime());

        $this->validateEntity($brand);

        $this->storeEntity($brand);

        return $brand;
    }

    /**
     * @param array $data
     * @param Brand $existBrand
     */
    public function update(array $data, Brand $existBrand)
    {
        /** @var Brand $brand */
        $brand = $this->serializer->deserialize(json_encode($data), Brand::class, 'json', [
            'object_to_populate' => $existBrand
        ]);
        $brand->setUpdated(new \DateTime());

        $this->validateEntity($brand);

        $this->storeEntity($brand);
    }

    /**
     * @param Brand $brand
     */
    public function delete(Brand $brand)
    {
        $this->removeEntity($brand);
    }
}
