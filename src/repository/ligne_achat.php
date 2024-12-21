<?php

    require_once("src/model/ligne_achat.php");

    class Ligne_achatRepository
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
                    "SELECT * FROM PROD_ligne_achat"
                );


                $statement->execute();
                
                $ligne_achats = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $ligne_achat = new Ligne_achat();
                    $ligne_achat->matiere_premiere = $row['matiere_premiere'];
                    $ligne_achat->valeur = $row['valeur'];
                    $ligne_achat->quantite = $row['quantite'];
                    $ligne_achat->pu = $row['pu'];
                    $ligne_achat->achat = $row['achat'];

                    $ligne_achats[] = $ligne_achat;
                }
                
                return $ligne_achats;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($ligne_achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_ligne_achat(matiere_premiere,valeur,quantite,pu,achat) 
                    VALUES(:matiere_premiere,:valeur,:quantite,:pu,:achat)"
                );

                $statement->bindParam(':matiere_premiere',$ligne_achat->matiere_premiere);
                $statement->bindParam(':valeur',$ligne_achat->valeur);
                $statement->bindParam(':quantite',$ligne_achat->quantite);
                $statement->bindParam(':pu',$ligne_achat->pu);
                $statement->bindParam(':achat',$ligne_achat->achat);

                $statement->execute();
                                
                return $ligne_achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }