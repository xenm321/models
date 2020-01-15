<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class AbstractPhoto
 * @package Model\Entity
 */
abstract class AbstractPhoto extends AbstractEntity
{
    // Оригинальный файл
    const TYPE_ORIGINAL = 'original';
    // 1200x1200
    const TYPE_BIG = 'big';
    // 800x800
    const TYPE_MEDIUM = 'medium';
    // 332x332
    const TYPE_SMALL = 'small';
    // 100x100
    const TYPE_THUMB = 'thumb';

    /**
     * Оригинальное название файла
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     * @Groups({"modelsList", "model"})
     */
    protected $name;

    /**
     * @Vich\UploadableField(mapping="models", fileNameProperty="path")
     */
    protected $imageFile;

    /**
     * Путь до файла
     * @var string
     *
     * @ORM\Column(type="string", name="path")
     * @Groups({"modelsList", "model"})
     */
    protected $path;

    /**
     * Размер файла в байтах
     * @var integer
     *
     * @ORM\Column(type="integer", name="size")
     * @Groups({"modelsList"})
     */
    protected $size;

    /**
     * Ширина в пикселях
     * @var integer
     *
     * @ORM\Column(type="integer", name="width")
     */
    protected $width;

    /**
     * Высота в пикселях
     * @var integer
     *
     * @ORM\Column(type="integer", name="height")
     */
    protected $height;

    /**
     * Mime-тип файла
     * @var string
     *
     * @ORM\Column(type="string", name="mime_type")
     */
    protected $mimeType;

    /**
     * @var string
     * @ORM\Column(type="string", name="type")
     */
    protected $type;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return UploadedFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updated = new \DateTime('now');
        }
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType(string $mimeType): void
    {
        $this->mimeType = $mimeType;
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
}
