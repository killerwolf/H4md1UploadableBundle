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
        return $file ? $this->um->getFilesystemByEntity('H4md1\AppBundle\Entity\Website')->getMetadata($file) : null ;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return mixed|null
     */
    public function reverseTransform($file)
    {
        $this->um
            ->getFilesystemByEntity('H4md1\AppBundle\Entity\Website')
            ->write(
                $file->getClientOriginalName(),
                $this->um->getFilesystem('tmp')->read($file->getBasename()
            )
        );
        return $file->getClientOriginalName();
    }
}