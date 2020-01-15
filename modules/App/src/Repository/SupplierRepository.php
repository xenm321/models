<?php

namespace App\Repository;

use App\Entity\Supplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class SupplierRepository
 * @package App\Repository
 */
class SupplierRepository extends ServiceEntityRepository
{
    private $paginator;
    private $sortFields = ['id', 'title'];

    /**
     * DirectionRepository constructor.
     * @param RegistryInterface $registry
     * @param PaginatorInterface $paginator
     */
    public function __construct(RegistryInterface $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Supplier::class);
        $this->paginator = $paginator;
    }

    /**
     * @param int    $page
     * @param string $sortBy
     * @param bool   $descending
     * @param int    $perPage
     *
     * @return PaginationInterface
     */
    public function fetchAll(int $page, string $sortBy, bool $descending, int $perPage): PaginationInterface
    {
        $qb = $this->createQueryBuilder('d')->select('d');

        if (in_array($sortBy, $this->sortFields)) {
            $qb->orderBy('d.'.$sortBy, $descending ? 'DESC' : 'ASC');
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
