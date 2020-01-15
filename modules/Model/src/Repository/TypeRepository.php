<?php

namespace Model\Repository;

use Model\Entity\Dictionary\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class TypeRepository.
 */
class TypeRepository extends ServiceEntityRepository
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
        parent::__construct($registry, Type::class);
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
        $qb = $this->createQueryBuilder('t')->select('t');

        if (in_array($sortBy, $this->sortFields)) {
            $qb->orderBy('t.'.$sortBy, $descending ? 'DESC' : 'ASC');
        }

        if(!empty($search)) {
            $qb->andWhere('t.code LIKE :search OR t.title LIKE :search OR t.description LIKE :search');
            $qb->setParameter('search', '%'.$search.'%');
        }

        return $this->paginator->paginate($qb->getQuery(), $page, $perPage);
    }
}
