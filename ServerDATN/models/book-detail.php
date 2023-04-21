<?php
class BookDetail
{
    public $bookid;
    public $title;
    public $price;
    public $quantity;
    public $categoryname;
    public $authorname;
    public $publishername;
    public $releasedate;
    public $description;

    public function __construct($bookid, $title, $price, $quantity, $categoryname, $authorname, $publishername, $releasedate, $description)
    {
        $this->bookid = $bookid;
        $this->title = $title;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->categoryname = $categoryname;
        $this->authorname = $authorname;
        $this->publishername = $publishername;
        $this->releasedate = $releasedate;
        $this->description = $description;
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
     * Get the value of categoryname
     */
    public function getCategoryname()
    {
        return $this->categoryname;
    }

    /**
     * Set the value of categoryname
     */
    public function setCategoryname($categoryname): self
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    /**
     * Get the value of authorname
     */
    public function getAuthorname()
    {
        return $this->authorname;
    }

    /**
     * Set the value of authorname
     */
    public function setAuthorname($authorname): self
    {
        $this->authorname = $authorname;

        return $this;
    }

    /**
     * Get the value of publishername
     */
    public function getPublishername()
    {
        return $this->publishername;
    }

    /**
     * Set the value of publishername
     */
    public function setPublishername($publishername): self
    {
        $this->publishername = $publishername;

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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }
}
