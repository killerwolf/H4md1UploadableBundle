<?php

namespace H4md1\AppBundle\Filesystem\Adapter;

interface FilesystemInterface{
    public function exists($src);
    public function rename($src, $name);

}