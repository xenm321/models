<?php

namespace Model\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Model\Entity\Specification;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SpecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Specification::class);
    }

    public function fetchAll(string $search = '', array $filters = [])
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s');

        if(!empty($search)) {
            $qb->andWhere('s.code LIKE :search OR s.title LIKE :search');
            $qb->setParameter('search', '%'.$search.'%');
        }

        if(!empty($filters['type']) && is_array($filters['type'])) {
            $qb->andWhere('s.types IN (:type)');
            $qb->setParameter('type', $filters['type']);
        }

        if(!empty($filters['role'])) {
            $qb->andWhere('s.role = :role');
            $qb->setParameter('role', $filters['role']);
        }

        return $qb->getQuery()->getResult();
    }
}
