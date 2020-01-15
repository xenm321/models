<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends AbstractEntity implements UserInterface
{
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank
     * @Groups({"oneUser"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @Groups({"oneUser"})
     */
    private $active;

    /**
     * Направление закупки
     *
     * @var Direction|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Direction")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"frontend"})
     */
    private $direction;

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return Direction|null
     */
    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    /**
     * @param Direction $direction
     */
    public function setDirection(Direction $direction): void
    {
        $this->direction = $direction;
    }

    public function eraseCredentials()
    {
    }
}
