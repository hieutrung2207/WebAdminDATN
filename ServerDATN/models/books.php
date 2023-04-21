<?php
class Book
{
       public $bookid;
       public $title;
       public $price;
       public $quantity;
       public $categoryid;
       public $authorid;
       public $publisherid;
       public $releasedate;
       public $url;

       public $state;

       public function __construct($bookid, $title, $price, $quantity, $categoryid, $authorid, $publisherid, $releasedate, $url, $state)
       {
              $this->bookid = $bookid;
              $this->title = $title;
              $this->price = $price;
              $this->quantity = $quantity;
              $this->categoryid = $categoryid;
              $this->authorid = $authorid;
              $this->publisherid = $publisherid;
              $this->releasedate = $releasedate;
              $this->url = $url;
              $this->state = $state;
       }

       /**
        * Get the value of bookid
        */
       public function getBookid()
       {
              return $this->bookid;
       }

       /**
        * Set the value of bookid
        */
       public function setBookid($bookid): self
       {
              $this->bookid = $bookid;

              return $this;
       }

       /**
        * Get the value of title
        */
       public function getTitle()
       {
              return $this->title;
       }

       /**
        * Set the value of title
        */
       public function setTitle($title): self
       {
              $this->title = $title;

              return $this;
       }

       /**
        * Get the value of price
        */
       public function getPrice()
       {
              return $this->price;
       }

       /**
        * Set the value of price
        */
       public function setPrice($price): self
       {
              $this->price = $price;

              return $this;
       }

       /**
        * Get the value of quantity
        */
       public function getQuantity()
       {
              return $this->quantity;
       }

       /**
        * Set the value of quantity
        */
       public function setQuantity($quantity): self
       {
              $this->quantity = $quantity;

              return $this;
       }

       /**
        * Get the value of categoryid
        */
       public function getCategoryid()
       {
              return $this->categoryid;
       }

       /**
        * Set the value of categoryid
        */
       public function setCategoryid($categoryid): self
       {
              $this->categoryid = $categoryid;

              return $this;
       }

       /**
        * Get the value of authorid
        */
       public function getAuthorid()
       {
              return $this->authorid;
       }

       /**
        * Set the value of authorid
        */
       public function setAuthorid($authorid): self
       {
              $this->authorid = $authorid;

              return $this;
       }

       /**
        * Get the value of publisherid
        */
       public function getPublisherid()
       {
              return $this->publisherid;
       }

       /**
        * Set the value of publisherid
        */
       public function setPublisherid($publisherid): self
       {
              $this->publisherid = $publisherid;

              return $this;
       }

       /**
        * Get the value of releasedate
        */
       public function getReleasedate()
       {
              return $this->releasedate;
       }

       /**
        * Set the value of releasedate
        */
       public function setReleasedate($releasedate): self
       {
              $this->releasedate = $releasedate;

              return $this;
       }

       /**
        * Get the value of url
        */
       public function getUrl()
       {
              return $this->url;
       }

       /**
        * Set the value of url
        */
       public function setUrl($url): self
       {
              $this->url = $url;

              return $this;
       }
       public function setState($state): self
       {
              $this->state = $state;

              return $this;
       }

       /**
        * Get the value of price
        */
       public function getState()
       {
              return $this->state;
       }
}
