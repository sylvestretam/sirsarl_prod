<?php

    require_once("src/model/expedition.php");

    class ExpeditionRepository
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
                    "SELECT * FROM PROD_expedition"
                );


                $statement->execute();
                
                $expeditions = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $expedition = new Expedition();
                    $expedition->expedition_id = $row['expedition_id'];
                    $expedition->date_expedition = $row['date_expedition'];
                    $expedition->valeur = $row['valeur'];
                    $expedition->observation = $row['observation'];
                    $expedition->uuid = $row['uuid'];

                    $expeditions[] = $expedition;
                }
                
                return $expeditions;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($expedition)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_expedition(date_expedition,valeur,observation,uuid) 
                    VALUES(:date_expedition,:valeur,:observation,:uuid)"
                );

                
                $statement->bindParam(':date_expedition',$expedition->date_expedition);
                $statement->bindParam(':valeur',$expedition->valeur);
                $statement->bindParam(':observation',$expedition->observation);
                $statement->bindParam(':uuid',$expedition->uuid);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM PROD_expedition WHERE uuid = :uuid"
                );

                $statement->bindParam(':uuid',$expedition->uuid);

                $statement->execute();

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $expedition->expedition_id = $row['expedition_id'];
                }
                                
                return $expedition;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


        public function delete($expedition)
        {
            try{
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_ligne_expedition WHERE expedition = :expedition_id"
                );

                $statement->bindParam(':expedition_id',$expedition->expedition_id);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_expedition WHERE expedition_id = :expedition_id"
                );

                $statement->bindParam(':expedition_id',$expedition->expedition_id);

                $statement->execute();
                                
                return $expedition;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }