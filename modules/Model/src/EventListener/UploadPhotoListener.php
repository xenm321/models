<?php

namespace Model\EventListener;

use Model\Entity\AbstractPhoto;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Vich\UploaderBundle\Event\Events;
use Vich\UploaderBundle\Event\Event;

class UploadPhotoListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            Events::PRE_UPLOAD => 'onVichUploaderPreUpload'
        ];
    }

    public function onVichUploaderPreUpload(Event $event)
    {
        $object = $event->getObject();

        if($object instanceof AbstractPhoto) {
            $file = $object->getImageFile();
            $object->setName($file->getClientOriginalName());
            $object->setSize($file->getSize());
            $object->setWidth(0);
            $object->setHeight(0);
            $object->setMimeType($file->getMimeType());
            $object->setType(AbstractPhoto::TYPE_ORIGINAL);
        }
    }
}
