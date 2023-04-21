<?php
include_once '../services/orders-services.php';

class OrderController
{
    private $services;
    public function __construct()
    {
        $this->services = new OrdersServices();
    }
    public function insertOrder($data)
    {
        return $this->services->insertOrder($data);
    }
    //done
    public function insertOrderDetail($data)
    {
        return $this->services->insertOrderDetail($data);
    }
    //done
    public function getAllOrderByUserID($userid)
    {
        return $this->services->getAllOrderByUserID($userid);
    }

    public function getOrderDetailByOrderID($orderid)
    {
        return $this->services->getOrderDetailByOrderID($orderid);
    }
    public function getOrderStatusDelivery($userid)
    {
        return $this->services->getOrderStatusDelivery($userid);
    }
    public function getOrderStatusCancel($userid)
    {
        return $this->services->getOrderStatusCancel($userid);
    }
    public function getOrderStatusSuccess($userid)
    {
        return $this->services->getOrderStatusSuccess($userid);
    }
}
