<?php

namespace Model\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Model\Entity\ModelExt;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ModelExtRepository
 * @package Model\Repository
 */
class ModelExtRepository extends ServiceEntityRepository
{
    /**
     * BrandRepository constructor.
     *
     * @param RegistryInterface  $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ModelExt::class);
    }

    /**
     * @param string $articul
     * @return array
     */
    public function findByArticul(string $articul)
    {
        return $this->findBy(['articul' => $articul]);
    }
}
