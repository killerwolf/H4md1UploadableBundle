<?php

namespace H4md1\UploadableBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use H4md1\UploadableBundle\Entity\UploadableEntityTrait;

class UploadableSubscriber implements EventSubscriber
{
    private $paths = [
        'tmp' => '/var/www/diaporama/var/tmp/upload',
        'website' => '/var/www/diaporama/var/upload/website'
    ];

    public function __construct(){
        $this->fs = new Filesystem();
    }

    public function setUploadRootDir($rootDir){
        $this->paths['default'] = $rootDir;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
            'preUpdate',
            'prePersist',
            'preRemove'
        );
    }

    public function preSave(LifecycleEventArgs $args){
        if(
            ($e = $args->getEntity())
            && $this->supports($e)
        ){
            $this->uploadFile($e);
        }
    }

    public function postSave(LifecycleEventArgs $args){
        if(
            ($e = $args->getEntity())
            && $this->supports($e)
            && null !== $e->getFile()
        ){
            //$this->fs->remove($e->getFullFilePath());
            $this->fs->mkdir($e->getUploadRootDir());
            $this->fs->rename($e->getTmpUploadRootDir().'/'.$e->getFilePath(), $e->getFullFilePath(),true);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->preSave($args);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->preSave($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->postSave($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->postSave($args);
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        if(
            ($e = $args->getEntity()) 
            && $this->supports($e)
        ){
            $this->removeFile($e);
        }
    }

    /**
     * @param UploadableEntityTrait $e
     */
    private function uploadFile($e) {

        // the file property can be empty if the field is not required
        if (null === $e->getFile()) {
            return;
        }
        if (null !== $e->getFilePath())
        {
            //remove old one first
            $this->removeFile($e);
        }

        $this->fs->rename($e->getFile()->getPathname(), $e->getTmpUploadRootDir() . '/' . $e->getFile()->getClientOriginalName(),true);
        $e->setFilePath($e->getFile()->getClientOriginalName());
    }

    /**
     * @param UploadableEntityTrait $e
     */
    private function removeFile($e)
    {
        $this->fs->remove([$e->getFullFilePath(),$e->getUploadRootDir()]);
    }

    private function supports($entity)
    {
        return in_array('H4md1\UploadableBundle\Entity\UploadableEntityTrait', class_uses($entity));
    }
}