<?php

    require_once("src/model/ligne_consommation.php");

    class Ligne_consommationRepository
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
                    "SELECT * FROM PROD_ligne_consommation"
                );


                $statement->execute();
                
                $ligne_consommations = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $ligne_consommation = new Ligne_consommation();
                    $ligne_consommation->matiere_premiere = $row['matiere_premiere'];
                    $ligne_consommation->valeur = $row['valeur'];
                    $ligne_consommation->quantite = $row['quantite'];
                    $ligne_consommation->pu = $row['pu'];
                    $ligne_consommation->consommation = $row['consommation'];

                    $ligne_consommations[] = $ligne_consommation;
                }
                
                return $ligne_consommations;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($ligne_consommation)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_ligne_consommation(matiere_premiere,valeur,quantite,pu,consommation) 
                    VALUES(:matiere_premiere,:valeur,:quantite,:pu,:consommation)"
                );

                $statement->bindParam(':matiere_premiere',$ligne_consommation->matiere_premiere);
                $statement->bindParam(':valeur',$ligne_consommation->valeur);
                $statement->bindParam(':quantite',$ligne_consommation->quantite);
                $statement->bindParam(':pu',$ligne_consommation->pu);
                $statement->bindParam(':consommation',$ligne_consommation->consommation);

                $statement->execute();
                                
                return $ligne_consommation;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }