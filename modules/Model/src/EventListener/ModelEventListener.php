<?php

namespace Model\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Model\Entity\Model;

class ModelEventListener
{
    private $modelImageWebDir;

    public function __construct(string $modelImageWebDir)
    {
        $this->modelImageWebDir = $modelImageWebDir;
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if($object instanceof Model) {
            foreach ($object->getPhotos() as $photo) {
                $photo->setPath(sprintf('%s/%s', $this->modelImageWebDir, $photo->getPath()));
            }
        }
    }
}
