<?php
declare(strict_types=1);

namespace App\Serializer;

use App\Normalizer\EntityNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer as BaseSerializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class Serializer
 * @package App\Serializer
 */
class Serializer implements SerializerInterface
{
    /** @var BaseSerializer */
    protected $serializer;

    /** @var EntityNormalizer */
    protected $entityNormalizer;

    /**
     * Serializer constructor.
     * @param EntityNormalizer $entityNormalizer
     */
    public function __construct(EntityNormalizer $entityNormalizer)
    {
        $encoder = new JsonEncoder();
        $this->entityNormalizer = $entityNormalizer;
        $this->entityNormalizer->setCallbacks([
            'created' => function ($dateTime) {
                return $dateTime instanceof \DateTime
                    ? $dateTime->format(\DateTime::ATOM)
                    : null;
            },
            'updated' => function ($dateTime) {
                return $dateTime instanceof \DateTime
                    ? $dateTime->format(\DateTime::ATOM)
                    : null;
            }
        ]);

        $this->entityNormalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $this->serializer = new BaseSerializer([$this->entityNormalizer], [$encoder]);
    }

    /**
     * @param mixed $data
     * @param string $format
     * @param array $context
     * @return bool|float|int|string
     */
    public function serialize($data, $format, array $context = array())
    {
        return $this->serializer->serialize($data, $format);
    }

    public function deserialize($data, $type, $format, array $context = array())
    {
        // TODO: Implement deserialize() method.
    }


}