<?php
class OrderDetail
{
    public $orderdetailid;
    public $orderid;
    public $title;
    public $price;
    public $amount;
    public $total;
    public $url;

    public function __construct($orderdetailid, $orderid, $title, $price, $amount, $total, $url)
    {
        $this->orderdetailid = $orderdetailid;
        $this->orderid = $orderid;
        $this->title = $title;
        $this->price = $price;
        $this->amount = $amount;
        $this->total = $total;
        $this->url = $url;
    }

    /**
     * Get the value of orderdetailid
     */
    public function getOrderdetailid()
    {
        return $this->orderdetailid;
    }

    /**
     * Set the value of orderdetailid
     */
    public function setOrderdetailid($orderdetailid): self
    {
        $this->orderdetailid = $orderdetailid;

        return $this;
    }

    /**
     * Get the value of orderid
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Set the value of orderid
     */
    public function setOrderid($orderid): self
    {
        $this->orderid = $orderid;

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

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self
    {
        $this->total = $total;

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
}
