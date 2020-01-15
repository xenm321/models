<?php

namespace Model\Service;

use Doctrine\ORM\EntityManagerInterface;
use Model\Entity\Dictionary\Brand;
use Model\Entity\Dictionary\Type;
use Model\Exception\LogicException;
use Model\Repository\ModelExtRepository;

/**
 * Сервис генерации артикулов
 *
 * Class ArticulGenerationService
 * @package Model\Service
 */
class ArticulGenerationService
{
    /** @var ModelExtRepository  */
    protected $repository;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * ArticulGenerationService constructor.
     * @param ModelExtRepository $repository
     */
    public function __construct(ModelExtRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Type $type
     * @param Brand $brand
     * @return string
     */
    public function generateArticul(Type $type, Brand $brand)
    {
        /**
         * Формируется новая запись вида ХХZZZ-NN-AA, где:
         *   a. XX  – брендовый идентификатор из 2 символов
         *   b. ZZZ – очередной числовой идентификатор артикула внутри бренда
         *   c. NN  – идентификатор типа заведенного артикула
         *   d. AA  – размер модели, для размерного товара.
         */
        $articul = sprintf('%s%s-%s',
            $brand->getIdentifier(),
            $brand->incrementLastIndexNumber(),
            $type->getIdentifier()
        );

        if (count($this->repository->findByArticul($articul)) !== 0) {
            throw new LogicException('Ошибка генерации артикула. Такой артикул уже существует: ' . $articul);
        }

        // ToDo: Где сохранять инкремент идентификатора бренда?
        $this->entityManager->persist($brand);

        return $articul;
    }
}