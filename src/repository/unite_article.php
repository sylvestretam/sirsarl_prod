<?php

    require_once("src/model/unite_article.php");

    class Unite_articleRepository
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
                    "SELECT * FROM BTL_unite_article"
                );


                $statement->execute();
                
                $unite_articles = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $unite_stock = new Unite_article();
                    $unite_stock->article = $row['article'];
                    $unite_stock->unite = $row['unite'];

                    $unite_articles[] = $unite_stock;
                }
                
                return $unite_articles;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }
    }