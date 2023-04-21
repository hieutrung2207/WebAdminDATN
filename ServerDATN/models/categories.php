<?php
class Categories
{
        public $categoryid;
        public $categoryname;

        public function __construct($categoryid, $categoryname)
        {
                $this->categoryid = $categoryid;
                $this->categoryname = $categoryname;
        }

        /**
         * Get the value of categoryid
         */
        public function getCategoryID()
        {
                return $this->categoryid;
        }

        /**
         * Set the value of categoryid
         */
        public function setCategoryID($categoryid): self
        {
                $this->categoryid = $categoryid;

                return $this;
        }

        /**
         * Get the value of categoryname
         */
        public function getCategoryName()
        {
                return $this->categoryname;
        }

        /**
         * Set the value of categoryname
         */
        public function setCategoryName($categoryname): self
        {
                $this->categoryname = $categoryname;

                return $this;
        }
}
