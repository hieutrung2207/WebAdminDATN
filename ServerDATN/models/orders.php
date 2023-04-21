<?php
class Orders
{
    public $orderid;
    public $userid;
    public $createdate;
    public $note;
    public $fullname;
    public $phonenumber;
    public $address;
    public $payment;
    public $state;

    public function __construct($orderid, $userid, $createdate, $note, $fullname, $phonenumber, $address, $payment, $state)
    {
        $this->orderid = $orderid;
        $this->userid = $userid;
        $this->createdate = $createdate;
        $this->note = $note;
        $this->fullname = $fullname;
        $this->phonenumber = $phonenumber;
        $this->address = $address;
        $this->payment = $payment;
        $this->state = $state;
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
     * Get the value of userid
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     */
    public function setUserid($userid): self
    {
        $this->userid = $userid;

        return $this;
    }


    /**
     * Get the value of createdate
     */
    public function getCreatedate()
    {
        return $this->createdate;
    }

    /**
     * Set the value of createdate
     */
    public function setCreatedate($createdate): self
    {
        $this->createdate = $createdate;

        return $this;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     */
    public function setNote($note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of fullname
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set the value of fullname
     */
    public function setFullname($fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get the value of phonenumber
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set the value of phonenumber
     */
    public function setPhonenumber($phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     */
    public function setPayment($payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get the value of state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     */
    public function setState($state): self
    {
        $this->state = $state;

        return $this;
    }
}
