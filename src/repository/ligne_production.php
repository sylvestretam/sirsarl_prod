<?php

    require_once("src/model/ligne_production.php");

    class Ligne_productionRepository
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
                    "SELECT * FROM PROD_ligne_production"
                );


                $statement->execute();
                
                $ligne_productions = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $ligne_production = new ligne_production();
                    $ligne_production->article = $row['article'];
                    $ligne_production->valeur = $row['valeur'];
                    $ligne_production->quantite = $row['quantite'];
                    $ligne_production->unite = $row['unite'];
                    $ligne_production->production = $row['production'];

                    $ligne_productions[] = $ligne_production;
                }
                
                return $ligne_productions;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($ligne_production)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_ligne_production(article,quantite,unite,production) 
                    VALUES(:article,:quantite,:unite,:production)"
                );

                $statement->bindParam(':article',$ligne_production->article);
                $statement->bindParam(':quantite',$ligne_production->quantite);
                $statement->bindParam(':unite',$ligne_production->unite);
                $statement->bindParam(':production',$ligne_production->production);

                $statement->execute();
                                
                return $ligne_production;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }