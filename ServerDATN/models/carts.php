<?php
class Carts
{
    public $userid;
    public $bookid;
    public $amount;
    public $title;
    public $price;
    public $url;

    public function __construct($userid, $bookid, $amount, $title, $price, $url)
    {
        $this->userid = $userid;
        $this->bookid = $bookid;
        $this->amount = $amount;
        $this->title = $title;
        $this->price = $price;
        $this->url = $url;
    }

    /**
     * Get the value of userid
     */
    public function getUserID()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     */
    public function setUserID($userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get the value of bookid
     */
    public function getBookID()
    {
        return $this->bookid;
    }

    /**
     * Set the value of bookid
     */
    public function setBookID($bookid): self
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

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
