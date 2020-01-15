<?php

namespace Model\Repository;

use Model\Entity\Model;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class NewModelRepository
 * @package Model\Repository
 */
class NewModelRepository extends ServiceEntityRepository
{
    private $paginator;

    private $sortFields = [
        'type' => [
            'field' => 't.title',
        ],
        'brand' => [
            'field' => 'b.title',
        ],
        'title' => [
            'field' => 'm.title',
        ],
        'seoTitle' => [
            'field' => 'm.seoTitle',
        ],
        'created' => [
            'field' => 'm.created',
        ],
        'updated' => [
            'field' => 'm.updated',
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
        parent::__construct($registry, Model::class);
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

        $qb = $this->createQueryBuilder('m')
            ->select('m, t, b')
            ->leftJoin('m.brand', 'b')
            ->leftJoin('m.type', 't');

        $qb->where('m.status = :status')->setParameter('status', $status);

        if (isset($this->sortFields[$sortBy])) {
            $qb->orderBy($this->sortFields[$sortBy]['field'], $descending ? 'DESC' : 'ASC');
        }

        if(!empty($filters['search'])) {
            $qb->andWhere('m.title LIKE :search OR m.description LIKE :search OR m.seoTitle LIKE :search LIKE :search');
            $qb->setParameter('search', '%'.trim($filters['search']).'%');
        }

        if(!empty($filters['brand']) && is_array($filters['brand'])) {
            $qb->andWhere('m.brand IN (:brand)');
            $qb->setParameter('brand', $filters['brand']);
        }

        if(!empty($filters['type']) && is_array($filters['type'])) {
            $qb->andWhere('m.type IN (:type)');
            $qb->setParameter('type', $filters['type']);
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
