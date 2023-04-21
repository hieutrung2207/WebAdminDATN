<?php
class Images
{
    public $url;
    public $isdefault;

    public function __construct($url,$isdefault)
    {
        $this->isdefault = $isdefault;
        $this->url = $url;
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
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * Set the value of url
     */
    public function setIsdefault($isdefault): self
    {
        $this->isdefault = $isdefault;

        return $this;
    }
}
