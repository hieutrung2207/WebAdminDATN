<?php
include_once '../services/books-services.php';

class BookController
{
    private $services;
    public function __construct()
    {
        $this->services = new BookServices();
    }
    public function getAllBooks()
    {
        return $this->services->getAllBooks();
    }
    public function getImagesByBookID($bookid)
    {
        return $this->services->getImagesByBookID($bookid);
    }
    public function getBookDetail($bookid)
    {
        return $this->services->getBookDetail($bookid);
    }
    public function getBooksByCategory($categoryid)
    {
        return $this->services->getBooksByCategory($categoryid);
    }
    public function getBooksBySearchKey($searchkey)
    {
        return $this->services->getBooksBySearchKey($searchkey);
    }
    public function getBooksByAuthorID($authorid)
    {
        return $this->services->getBooksByAuthorID($authorid);
    }
    public function insertBook($data)
    {
        return $this->services->insertBook($data);
    }
    public function updateInformationBook($data)
    {
        return $this->services->updateInformationBook($data);
    }
    public function updateQuantityBook($data)
    {
        return $this->services->updateQuantityBook($data);
    }
}
