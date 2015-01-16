<?php

namespace H4md1\UploadableBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

trait UploadableEntityTrait{

    /**
     * @var string
     *
     * @ORM\Column(name="filePath", type="string", length=255, nullable=true)
     */
    private $filePath;

    /**
     * @var string
     *
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $_listeners = array();

    abstract public function getId();

    abstract public function getUploadRootDir();

    /**
     * Set file
     *
     * @param string $file
     * @return Website
     */
    public function setFile($file)
    {
        $this->_onPropertyChanged('filePath', $this->filePath, null);
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set filePath
     *
     * @param string $filePath
     * @return Website
     */
    public function setfilePath($filePath)
    {
        if($this->filePath !== $filePath){
            $this->_onPropertyChanged('filePath', null, $filePath);
            $this->filePath = $filePath;
        }
        return $this;
    }

    /**
     * Get filePath
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getFullFilePath() {
        return null === $this->filePath ? null : $this->getUploadRootDir().'/'. $this->filePath;
    }

    public function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return '/var/www/diaporama/var/tmp/upload';
    }
}