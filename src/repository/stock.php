<?php

    require_once("src/model/stock.php");

    class StockRepository
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
                    "SELECT * FROM PROD_stock"
                );


                $statement->execute();
                
                $stocks = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $stock = new stock();
                    $stock->quantite = $row['quantite'];
                    $stock->valeur = $row['valeur'];
                    $stock->unite = $row['unite'];
                    $stock->article = $row['article'];

                    $stocks[] = $stock;
                }
                
                return $stocks;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }