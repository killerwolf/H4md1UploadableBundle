<?php

namespace H4md1\UploadableBundle\Filesystem;

trait FilesystemAwareTrait {

    /**
     * @var \H4md1\AppBundle\Filesystem\Adapter\FilesystemInterface
     */
    private $fs;

    public function setFilesystem($fs){
        $this->fs = $fs;
        return $this;
    }

    public function getFilesystem(){
        return $this->fs;
    }
}