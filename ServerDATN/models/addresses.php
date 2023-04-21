<?php
class Addresses
{
        public $addressid;
        public $userid;
        public $location;
        public $ward;
        public $district;
        public $city;
        public $addressname;
        public $isdefault;

        public function __construct($addressid, $userid, $location, $ward, $district, $city, $addressname, $isdefault)
        {
                $this->addressid = $addressid;
                $this->userid = $userid;
                $this->location = $location;
                $this->ward = $ward;
                $this->district = $district;
                $this->city = $city;
                $this->addressname = $addressname;
                $this->isdefault = $isdefault;
        }

        /**
         * Get the value of addressid
         */
        public function getAddressid()
        {
                return $this->addressid;
        }

        /**
         * Set the value of addressid
         */
        public function setAddressid($addressid): self
        {
                $this->addressid = $addressid;

                return $this;
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
         * Get the value of location
         */
        public function getLocation()
        {
                return $this->location;
        }

        /**
         * Set the value of location
         */
        public function setLocation($location): self
        {
                $this->location = $location;

                return $this;
        }

        /**
         * Get the value of ward
         */
        public function getWard()
        {
                return $this->ward;
        }

        /**
         * Set the value of ward
         */
        public function setWard($ward): self
        {
                $this->ward = $ward;

                return $this;
        }

        /**
         * Get the value of district
         */
        public function getDistrict()
        {
                return $this->district;
        }

        /**
         * Set the value of district
         */
        public function setDistrict($district): self
        {
                $this->district = $district;

                return $this;
        }

        /**
         * Get the value of city
         */
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         */
        public function setCity($city): self
        {
                $this->city = $city;

                return $this;
        }

        /**
         * Get the value of addressname
         */
        public function getAddressname()
        {
                return $this->addressname;
        }

        /**
         * Set the value of addressname
         */
        public function setAddressname($addressname): self
        {
                $this->addressname = $addressname;

                return $this;
        }

        /**
         * Get the value of isdefault
         */
        public function getIsdefault()
        {
                return $this->isdefault;
        }

        /**
         * Set the value of isdefault
         */
        public function setIsdefault($isdefault): self
        {
                $this->isdefault = $isdefault;

                return $this;
        }
}
