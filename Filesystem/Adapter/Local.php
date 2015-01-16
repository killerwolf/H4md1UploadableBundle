<?php

namespace H4md1\AppBundle\Filesystem\Adapter;

use Symfony\Component\Filesystem\Filesystem;

class Local implements FilesystemInterface{

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $fs;

    public function  __constructor(){
        $this->fs = new Filesystem();
        return $this;
    }

    public function exists($src){
        $this->fs->exists([$src]);
    }

    public function rename($src, $dest){
        $this->fs->rename($src, $dest);
    }
}