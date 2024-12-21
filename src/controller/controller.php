<?php

    class Controller{

        private $dbconnect;

        public function __construct()
        {
            $this->dbconnect = new DbConnect();
        }

        public function show()
        {
            require("template/dashboard.php");
        }  
    }