<?php
include_once '../services/authors-services.php';

class AuthorController
{
    private $services;
    public function __construct()
    {
        $this->services = new AuthorsService();
    }
    public function getAllAuthors()
    {
        return $this->services->getAllAuthors();
    }
    public function getAuthorsDetail($authorid)
    {
        return $this->services->getAuthorsDetail($authorid);
    }
    public function insertAuthor($data)
    {
        return $this->services->insertAuthor($data);
    }
    public function updateAuthor($data)
    {
        return $this->services->updateAuthor($data);
    }
}
