<?php

    require_once("src/model/consommation.php");

    class ConsommationRepository
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
                    "SELECT * FROM PROD_consommation ORDER BY date_conso"
                );


                $statement->execute();
                
                $consommations = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $consommation = new Consommation();
                    $consommation->conso_id = $row['conso_id'];
                    $consommation->date_conso = $row['date_conso'];
                    $consommation->valeur = $row['valeur'];
                    $consommation->observation = $row['observation'];
                    $consommation->uuid = $row['uuid'];

                    $consommations[] = $consommation;
                }
                
                return $consommations;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($consommation)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_consommation(date_conso,valeur,observation,uuid,enreg_by) 
                    VALUES(:date_conso,:valeur,:observation,:uuid,:enreg_by)"
                );

                $statement->bindParam(':date_conso',$consommation->date_conso);
                $statement->bindParam(':valeur',$consommation->valeur);
                $statement->bindParam(':observation',$consommation->observation);
                $statement->bindParam(':enreg_by',$consommation->enreg_by);
                $statement->bindParam(':uuid',$consommation->uuid);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM PROD_consommation WHERE uuid = :uuid"
                );

                $statement->bindParam(':uuid',$consommation->uuid);

                $statement->execute();

                if($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $consommation->conso_id = $row['conso_id'];
                }
                                
                return $consommation;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


        public function delete($consommation)
        {
            try{
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_ligne_consommation WHERE consommation = :conso_id"
                );

                $statement->bindParam(':conso_id',$consommation->conso_id);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_consommation WHERE conso_id = :conso_id"
                );

                $statement->bindParam(':conso_id',$consommation->conso_id);

                $statement->execute();
                                
                return $consommation;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }