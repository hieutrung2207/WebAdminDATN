<?php
class Authors
{
        public $authorid;
        public $authorname;
        public $dob;
        public $description;

        public function __construct($authorid, $authorname, $dob, $description)
        {
                $this->authorid = $authorid;
                $this->authorname = $authorname;
                $this->dob = $dob;
                $this->description = $description;
        }

        /**
         * Get the value of authorid
         */
        public function getAuthorID()
        {
                return $this->authorid;
        }

        /**
         * Set the value of authorid
         */
        public function setAuthorID($authorid): self
        {
                $this->authorid = $authorid;

                return $this;
        }

        /**
         * Get the value of authorname
         */
        public function getAuthorName()
        {
                return $this->authorname;
        }

        /**
         * Set the value of authorname
         */
        public function setAuthorName($authorname): self
        {
                $this->authorname = $authorname;

                return $this;
        }

        /**
         * Get the value of dob
         */
        public function getdob()
        {
                return $this->dob;
        }

        /**
         * Set the value of dob
         */
        public function setdob($dob): self
        {
                $this->dob = $dob;

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
