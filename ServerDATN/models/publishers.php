<?php

class Publishers
{
    public $publisherid;
    public $publishername;

    public function __construct($publisherid, $publishername)
    {
        $this->publisherid = $publisherid;
        $this->publishername = $publishername;
    }

    /**
     * Get the value of publisherid
     */
    public function getPublisherID()
    {
        return $this->publisherid;
    }

    /**
     * Set the value of publisherid
     */
    public function setPublisherID($publisherid): self
    {
        $this->publisherid = $publisherid;

        return $this;
    }

    /**
     * Get the value of publishername
     */
    public function getPublisherName()
    {
        return $this->publishername;
    }

    /**
     * Set the value of publishername
     */
    public function setPublisherName($publishername): self
    {
        $this->publishername = $publishername;

        return $this;
    }
}
