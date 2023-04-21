<?php
include_once '../services/carts-services.php';

class CartController
{
    private $services;
    public function __construct()
    {
        $this->services = new CartsServices();
    }
    public function getAllCartsByUserID($userid)
    {
        return $this->services->getAllCartsByUserID($userid);
    }
    public function insertCart($data)
    {
        return $this->services->insertCart($data);
    }
    public function getRemoveCart($data)
    {
        return $this->services->getRemoveCart($data);
    }
    public function getAddQuantity($data)
    {
        return $this->services->getAddQuantity($data);
    }
    public function getMinusQuantity($data)
    {
        return $this->services->getMinusQuantity($data);
    }
    public function getRemoveCartIfQuantity0($data)
    {
        return $this->services->getRemoveCartIfQuantity0($data);
    }
}
