<?php
include_once '../services/categories-services.php';

class CategoryController{
    private $services;
    public function __construct()
    {
        $this->services = new CategoriesService();
    }
    public function getAllCategories()
    {
        return $this->services->getAllCategories();
    }
   
}