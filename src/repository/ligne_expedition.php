<?php

    require_once("src/model/ligne_expedition.php");

    class Ligne_expeditionRepository
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
                    "SELECT * FROM PROD_ligne_expedition"
                );


                $statement->execute();
                
                $ligne_expeditions = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $ligne_expedition = new Ligne_expedition();
                    $ligne_expedition->article = $row['article'];
                    $ligne_expedition->valeur = $row['valeur'];
                    $ligne_expedition->quantite = $row['quantite'];
                    $ligne_expedition->unite = $row['unite'];
                    $ligne_expedition->expedition = $row['expedition'];

                    $ligne_expeditions[] = $ligne_expedition;
                }
                
                return $ligne_expeditions;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($ligne_expedition)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_ligne_expedition(expedition,article,valeur,quantite,unite) 
                    VALUES(:expedition,:article,:valeur,:quantite,:unite)"
                );

                $statement->bindParam(':expedition',$ligne_expedition->expedition);
                $statement->bindParam(':valeur',$ligne_expedition->valeur);
                $statement->bindParam(':article',$ligne_expedition->article);
                $statement->bindParam(':quantite',$ligne_expedition->quantite);
                $statement->bindParam(':unite',$ligne_expedition->unite);

                $statement->execute();
                                
                return $ligne_expedition;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }