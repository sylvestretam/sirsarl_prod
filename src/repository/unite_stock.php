<?php

    require_once("src/model/unite_stock.php");

    class Unite_stockRepository
    {
        private $dbconnect;

        public function __construct($dbconnect)
        {
            $this->dbconnect = $dbconnect;
        }

        public function getAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM BTL_unite_stock"
                );


                $statement->execute();
                
                $unite_stocks = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $unite_stock = new Unite_stock();
                    $unite_stock->code_unite = $row['code_unite'];
                    $unite_stock->designation = $row['designation'];
                    $unite_stock->description = $row['description'];

                    $unite_stocks[] = $unite_stock;
                }
                
                return $unite_stocks;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }
    }