<?php

class User
{
        public $userid;
        public $email;
        public $password;
        public $fullname;
        public $phonenumber;
        public $role;
        public $state;

        public function __construct($userid, $email, $password, $fullname, $phonenumber, $role, $state)
        {
                $this->userid = $userid;
                $this->email = $email;
                $this->password = $password;
                $this->fullname = $fullname;
                $this->phonenumber = $phonenumber;
                $this->role = $role;
                $this->state = $state;
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
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         */
        public function setPassword($password): self
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of fullname
         */
        public function getFullName()
        {
                return $this->fullname;
        }

        /**
         * Set the value of fullname
         */
        public function setFullName($fullname): self
        {
                $this->fullname = $fullname;

                return $this;
        }

        /**
         * Get the value of phonenumber
         */
        public function getPhoneNumber()
        {
                return $this->phonenumber;
        }

        /**
         * Set the value of phonenumber
         */
        public function setPhoneNumber($phonenumber): self
        {
                $this->phonenumber = $phonenumber;

                return $this;
        }

        /**
         * Get the value of role
         */
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         */
        public function setRole($role): self
        {
                $this->role = $role;

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
