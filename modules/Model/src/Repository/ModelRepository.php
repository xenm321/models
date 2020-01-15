<?php

namespace Model\Repository;

use Model\Entity\ModelExt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class ModelRepository.
 */
class ModelRepository extends ServiceEntityRepository
{
    private $paginator;

    private $sortFields = [
        'articul' => [
            'field' => 'me.articul',
        ],
        'shop' => [
            'field' => 'me.shop',
        ],
        'price' => [
            'field' => 'me.price',
        ],
        'fullPrice' => [
            'field' => 'me.fullPrice',
        ],
        'type' => [
            'field' => 't.title',
        ],
        'brand' => [
            'field' => 'b.title',
        ],
        'title' => [
            'field' => 'me.title',
        ],
        'seoTitle' => [
            'field' => 'me.seoTitle',
        ],
        'purchasePriceRur' => [
            'field' => 'm.purchasePriceRur',
        ],
        'originalPriceRur' => [
            'field' => 'm.originalPriceRur',
        ],
        'created' => [
            'field' => 'me.created',
        ],
        'updated' => [
            'field' => 'me.updated',
        ],
    ];

    /**
     * ModelRepository constructor.
     *
     * @param RegistryInterface  $registry
     * @param PaginatorInterface $paginator
     */
    public function __construct(RegistryInterface $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, ModelExt::class);
        $this->paginator = $paginator;
    }

    /**
     * @param int    $page
     * @param string $sortBy
     * @param bool   $descending
     * @param int    $perPage
     * @param string $status
     * @param array  $filters
     *
     * @return PaginationInterface
     */
    public function fetchAll(int $page, string $sortBy, bool $descending, int $perPage, $status, array $filters = []): PaginationInterface
    {
        // TODO сделать фильтрацию значений фильтра на клиенте
        $filters = array_map(function($item) {
            return $item === 'null'? '': $item;
        }, $filters);

        $qb = $this->createQueryBuilder('me')
            ->select('me, m, t, s, b')
            ->join('me.model', 'm')
            ->join('me.shop', 's')
            ->leftJoin('m.brand', 'b')
            ->leftJoin('m.type', 't');

        $qb->where('m.status = :status')->setParameter('status', $status);

        if (isset($this->sortFields[$sortBy])) {
            $qb->orderBy($this->sortFields[$sortBy]['field'], $descending ? 'DESC' : 'ASC');
        }

        if(!empty($filters['search'])) {
            $qb->andWhere('m.title LIKE :search OR m.description LIKE :search OR m.seoTitle LIKE :search OR me.title LIKE :search OR me.description LIKE :search OR me.seoTitle LIKE :search');
            $qb->setParameter('search', '%'.trim($filters['search']).'%');
        }

        if(!empty($filters['articul'])) {
            $qb->andWhere('me.articul = :articul');
            $qb->setParameter('articul', $filters['articul']);
        }

        if(!empty($filters['brand']) && is_array($filters['brand'])) {
            $qb->andWhere('m.brand IN (:brand)');
            $qb->setParameter('brand', $filters['brand']);
        }

        if(!empty($filters['type']) && is_array($filters['type'])) {
            $qb->andWhere('m.type IN (:type)');
            $qb->setParameter('type', $filters['type']);
        }

        if(!empty($filters['shop']) && is_array($filters['shop'])) {
            $qb->andWhere('me.shop IN (:shop)');
            $qb->setParameter('shop', $filters['shop']);
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
