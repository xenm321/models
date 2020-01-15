<?php

namespace Model\Naming;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class PhotoFileNamer implements NamerInterface
{
    public function name($object, PropertyMapping $mapping): string
    {
        /**
         * @var UploadedFile $file
         */
        $file = $object->getImageFile();

        return time().'_'.$file->getClientOriginalName();
    }
}
