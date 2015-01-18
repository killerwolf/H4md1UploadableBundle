<?php

namespace H4md1\UploadableBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class FileToPathTransformer implements DataTransformerInterface
{

    /**
     * @var \H4md1\UploadableBundle\UploadManager
     */
    private $um;

    public function __construct($um)
    {
        $this->um = $um;
    }

    /**
     * @param mixed $file
     * @return null|File
     */
    public function transform($file)
    {
        //return $file ? new File('/var/www/diaporama/var/tmp/upload/'.$file) : null ;
        //dump($this->um->getFilesystem('lfs')->getMetadata($file));
        return $file ? $this->um->getFilesystemByEntity('H4md1\AppBundle\Entity\Website')->getMetadata($file) : null ;

    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return mixed|null
     */
    public function reverseTransform($file)
    {
    	//move uploaded file to a temporary location
        //$file->move('/var/www/diaporama/var/tmp/upload/', $file->getClientOriginalName());
    	//return $file->getClientOriginalName();

        $fileObject = $file->openFile();

        $this->mm->getFilesystem('lfs')->write($file->getClientOriginalName(),$this->mm->getFilesystem('lfs_tmp')->read($file->getBasename()));
        //$this->fs->write('plip',$this->fs->readAndDelete())
        return $file->getClientOriginalName();
    }
}