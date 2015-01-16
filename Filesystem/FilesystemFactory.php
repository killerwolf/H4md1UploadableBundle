<?php

namespace H4md1\AppBundle\Filesystem;

class FilesystemFactory{

    private $adapter;

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function get(){

        if (is_callable($this->adapter))
            return new $this->adapter();
    }
}