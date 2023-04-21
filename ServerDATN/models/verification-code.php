<?php
class Verification
{
       public $code;


       public function __construct($code)
       {
              $this->code = $code;
              
       }

       public function getCode()
       {
              return $this->code;
       }

       /**
        * Set the value of bookid
        */
       public function setCode($code): self
       {
              $this->code = $code;

              return $this;
       }

      
}
