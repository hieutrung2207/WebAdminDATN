<?php
include_once '../services/images-services.php';

class ImagesController
{
    private $services;
    public function __construct()
    {
        $this->services = new ImagesServices();
    }
    public function insertImages($data)
    {
        return $this->services->insertImages($data);
    }
    public function removeImages($imageid)
    {
        return $this->services->removeImages($imageid);
    }
    public function updateImages($data)
    {
        return $this->services->updateImages($data);
    }
    public function changeDefaultAllow($imageid)
    {
        return $this->services->changeDefaultAllow($imageid);
    }
    public function changeDefaultDeny($imageid)
    {
        return $this->services->changeDefaultDeny($imageid);
    }
}
