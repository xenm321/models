<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Class AbstractManager.
 */
abstract class AbstractManager
{
    protected $entityManager;
    protected $validator;
    protected $serializer;
    private $constraintErrors;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->constraintErrors = [];
    }

    protected function storeEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    protected function removeEntity($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    protected function violationToArray(ConstraintViolationListInterface $violationsList, string $propertyPath = null): array
    {
        $output = [];
        foreach ($violationsList as $violation) {
            $output[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        if (null !== $propertyPath) {
            if (array_key_exists($propertyPath, $output)) {
                $output = [$propertyPath => $output[$propertyPath]];
            } else {
                return [];
            }
        }

        return $output;
    }

    protected function validateEntity($entity)
    {
        $errors = $this->validator->validate($entity);

        if (count($errors)) {
            $this->setConstraintErrors($this->violationToArray($errors));
            throw new ValidatorException('Ошибка валидации сущности');
        }
    }

    public function getConstraintErrors(): array
    {
        return $this->constraintErrors;
    }

    protected function setConstraintErrors(array $constraintErrors)
    {
        $this->constraintErrors = $constraintErrors;
    }
}
