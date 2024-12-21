<?php

    require_once("src/model/production.php");

    class ProductionRepository
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
                    "SELECT * FROM PROD_production ORDER BY date_prod"
                );


                $statement->execute();
                
                $productions = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $production = new Production();
                    $production->prod_id = $row['prod_id'];
                    $production->date_prod = $row['date_prod'];
                    $production->observation = $row['observation'];
                    $production->uuid = $row['uuid'];
                    $production->enreg_by = $row['enreg_by'];

                    $productions[] = $production;
                }
                
                return $productions;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($production)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_production(date_prod,observation,uuid,enreg_by) 
                    VALUES(:date_prod,:observation,:uuid,:enreg_by)"
                );

                $statement->bindParam(':date_prod',$production->date_prod);
                $statement->bindParam(':observation',$production->observation);
                $statement->bindParam(':uuid',$production->uuid);
                $statement->bindParam(':enreg_by',$production->enreg_by);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM PROD_production WHERE uuid = :uuid"
                );

                $statement->bindParam(':uuid',$production->uuid);

                $statement->execute();

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $production->prod_id = $row['prod_id'];
                }
                                
                return $production;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


        public function delete($production)
        {
            try{
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_ligne_production WHERE production = :prod_id"
                );

                $statement->bindParam(':prod_id',$production->prod_id);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_production WHERE prod_id = :prod_id"
                );

                $statement->bindParam(':prod_id',$production->prod_id);

                $statement->execute();
                                
                return $production;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }