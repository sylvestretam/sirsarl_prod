<?php

    require_once("src/model/matiere_premiere.php");

    class Matiere_premiereRepository
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
                    "SELECT * FROM PROD_matiere_premiere"
                );


                $statement->execute();
                
                $matiere_premieres = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $matiere_premiere = new Matiere_premiere();
                    $matiere_premiere->code_mp = $row['code_mp'];
                    $matiere_premiere->designation = $row['designation'];
                    $matiere_premiere->unite = $row['unite'];
                    $matiere_premiere->quantite_stock = $row['quantite_stock'];
                    $matiere_premiere->pu_stock = $row['pu_stock'];
                    $matiere_premiere->valeur_stock = $row['valeur_stock'];

                    $matiere_premieres[] = $matiere_premiere;
                }
                
                return $matiere_premieres;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($matiere_premiere)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_matiere_premiere(code_mp,designation,unite,quantite_stock,pu_stock,valeur_stock) 
                    VALUES(:code_mp,:designation,:unite,:quantite_stock,:pu_stock,:valeur_stock)"
                );

                $statement->bindParam(':code_mp',$matiere_premiere->code_mp);
                $statement->bindParam(':designation',$matiere_premiere->designation);
                $statement->bindParam(':unite',$matiere_premiere->unite);
                $statement->bindParam(':quantite_stock',$matiere_premiere->quantite_stock);
                $statement->bindParam(':pu_stock',$matiere_premiere->pu_stock);
                $statement->bindParam(':valeur_stock',$matiere_premiere->valeur_stock);

                $statement->execute();

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


        public function delete($matiere_premiere)
        {
            try{

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_matiere_premiere WHERE code_mp = :code_mp"
                );

                $statement->bindParam(':code_mp',$matiere_premiere->code_mp);

                $statement->execute();
                                
                return $matiere_premiere;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }