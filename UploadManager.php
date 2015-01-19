<?php

namespace H4md1\UploadableBundle;

class UploadManager{
    /**
     * @var array
     */
    private $mappings;

    /**
     * @var \League\Flysystem\MountManager
     */
    private $mm;

    public function setMountManager($mm){
        $this->mm = $mm;
        return $this;
    }

    public function setMappings($m){
        $this->mappings = $m;
        return $this;
    }

    public function getMountManager(){
        return $this->mm;
    }

    public function getFilesystemByEntity($fqdn){
        $fs = array_filter(
            $this->mappings,
            function($mapping) use ($fqdn) {
                if($mapping['entity'] == $fqdn)
                {
                    return true;
                }
                return false;
            }
        );
        return $this->mm->getFilesystem(array_pop($fs)['filesystem']);
    }

    public function getFilesystem($fs){
        return $this->mm->getFilesystem($fs);
    }
}