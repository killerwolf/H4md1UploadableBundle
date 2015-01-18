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
            }
        )['filesystem'];
        return $this->mm->getFilesystem($fs);
    }

    public function setMappings($m){
        die();
        $this->mappings = $m;
    }
}