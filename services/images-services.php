<?php
include_once '../configs/dbconfig.php';
include_once '../models/images.php';
include_once '../models/respone.php';

class ImagesServices
{
    public $connect;
    public function __construct()
    {
        $this->connect = (new DBConfig())->getConnect();
    }
}
