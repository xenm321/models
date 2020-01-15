<?php

namespace Model\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Model\Entity\TypePurchaseConfig;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class TypePurchaseConfigRepository
 * @package Model\Repository
 */
class TypePurchaseConfigRepository extends ServiceEntityRepository
{
    private $paginator;
    private $sortFields = ['id', 'code', 'title', 'created', 'updated'];

    /**
     * BrandRepository constructor.
     *
     * @param RegistryInterface  $registry
     * @param PaginatorInterface $paginator
     */
    public function __construct(RegistryInterface $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, TypePurchaseConfig::class);
        $this->paginator = $paginator;
    }

    /**
     * @param int $page
     * @param string $sortBy
     * @param bool $descending
     * @param int $perPage
     * @param array $filters
     * @return PaginationInterface
     */
    public function fetchAll(int $page, string $sortBy, bool $descending, int $perPage, array $filters = []): PaginationInterface
    {
        // TODO сделать фильтрацию значений фильтра на клиенте
        $filters = array_map(function($item) {
            return $item === 'null'? '': $item;
        }, $filters);

        $qb = $this->createQueryBuilder('c')
            ->select('c');

        if(!empty($filters['type']) && is_array($filters['type'])) {
            $qb->andWhere('c.type IN (:type)');
            $qb->setParameter('type', $filters['type']);
        }

        if(!empty($filters['direction']) && is_array($filters['direction'])) {
            $qb->andWhere('c.direction IN (:direction)');
            $qb->setParameter('direction', $filters['direction']);
        }

        if (in_array($sortBy, $this->sortFields)) {
            $qb->orderBy('c.'.$sortBy, $descending ? 'DESC' : 'ASC');
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
