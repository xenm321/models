<?php
namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * История событий (лог изменения основных сущностей)
 *
 * Class AbstractEvent
 * @package App\Entity
 */
abstract class AbstractEvent
{
    // Создание модели
    const TYPE_CREATE = 'create';

    // Изменение поля
    const TYPE_CHANGE_FIELD = 'changeField';

    // Системное событие (не инициированное пользователем)
    const TYPE_SYSTEM = 'system';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * Дата создания записи.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     * @Groups({"frontend"})
     */
    protected $created;

    /**
     * Тип события
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"frontend"})
     */
    protected $type;

    /**
     * Пользователь, инициировавший событие
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"frontend"})
     */
    private $user;

    /**
     * Текстовое описание события
     *
     * @var string|null
     *
     * @ORM\Column(type="string")
     * @Groups({"frontend"})
     */
    private $event;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return null|string
     */
    public function getEvent(): ?string
    {
        return $this->event;
    }

    /**
     * @param null|string $event
     */
    public function setEvent(?string $event): void
    {
        $this->event = $event;
    }
}