<?php

namespace Model\Repository;

use Model\Entity\Dictionary\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class BrandRepository.
 */
class BrandRepository extends ServiceEntityRepository
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
        parent::__construct($registry, Brand::class);
        $this->paginator = $paginator;
    }

    /**
     * @param int    $page
     * @param string $sortBy
     * @param bool   $descending
     * @param int    $perPage
     * @param string $search
     *
     * @return PaginationInterface
     */
    public function fetchAll(int $page, string $sortBy, bool $descending, int $perPage, string $search = ''): PaginationInterface
    {
        $qb = $this->createQueryBuilder('b')->select('b');

        if (in_array($sortBy, $this->sortFields)) {
            $qb->orderBy('b.'.$sortBy, $descending ? 'DESC' : 'ASC');
        }

        if(!empty($search)) {
            $qb->andWhere('b.code LIKE :search OR b.title LIKE :search OR b.description LIKE :search');
            $qb->setParameter('search', '%'.$search.'%');
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
