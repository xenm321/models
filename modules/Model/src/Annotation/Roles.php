<?php

namespace Model\Annotation;

use Model\Exception\InvalidArgumentException;

/**
 * Annotation class for @Roles().
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Roles
{
    /**
     * @var string[]
     */
    private $roles;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (!isset($data['value']) || !$data['value']) {
            throw new InvalidArgumentException(sprintf('Parameter of annotation "%s" cannot be empty.', \get_class($this)));
        }

        $value = (array) $data['value'];
        foreach ($value as $role) {
            if (!\is_string($role)) {
                throw new InvalidArgumentException(sprintf('Parameter of annotation "%s" must be a string or an array of strings.', \get_class($this)));
            }
        }

        $this->roles = $value;
    }

    /**
     * Gets roles.
     *
     * @return string[]
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
