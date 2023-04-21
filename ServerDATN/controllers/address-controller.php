<?php
include_once '../services/addresses-services.php';

class AddressController
{
    private $services;
    public function __construct()
    {
        $this->services = new AddressServices();
    }

    public function getAllAddressesByUserID($userid)
    {
        return $this->services->getAllAddressesByUserID($userid);
    }
    public function insertAdress($data)
    {
        return $this->services->insertAdress($data);
    }
    public function updateAdress($data)
    {
        return $this->services->updateAdress($data);
    }
    public function removeAddress($data)
    {
        return $this->services->removeAddress($data);
    }
    public function getDefaultAddressByUserID($userid)
    {
        return $this->services->getDefaultAddressByUserID($userid);
    }
}
