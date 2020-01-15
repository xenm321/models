<?php

namespace App\Repository;

use App\Entity\Shop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class ShopRepository
 * @package App\Repository
 */
class ShopRepository extends ServiceEntityRepository
{
    private $paginator;
    private $sortFields = ['id', 'code', 'title', 'created'];

    /**
     * BrandRepository constructor.
     *
     * @param RegistryInterface  $registry
     * @param PaginatorInterface $paginator
     */
    public function __construct(RegistryInterface $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Shop::class);
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
        $qb = $this->createQueryBuilder('s')->select('s');

        if (in_array($sortBy, $this->sortFields)) {
            $qb->orderBy('s.'.$sortBy, $descending ? 'DESC' : 'ASC');
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
