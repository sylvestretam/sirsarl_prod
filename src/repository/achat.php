<?php

    require_once("src/model/achat.php");

    class AchatRepository
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
                    "SELECT * FROM PROD_achat ORDER BY date_achat"
                );


                $statement->execute();
                
                $achats = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $achat = new Achat();
                    $achat->achat_id = $row['achat_id'];
                    $achat->date_achat = $row['date_achat'];
                    $achat->valeur = $row['valeur'];
                    $achat->observation = $row['observation'];
                    $achat->enreg_by = $row['enreg_by'];
                    $achat->uuid = $row['uuid'];

                    $achats[] = $achat;
                }
                
                return $achats;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($achat)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO PROD_achat(date_achat,valeur,observation,uuid,enreg_by) 
                    VALUES(:date_achat,:valeur,:observation,:uuid,:enreg_by)"
                );

                $statement->bindParam(':date_achat',$achat->date_achat);
                $statement->bindParam(':valeur',$achat->valeur);
                $statement->bindParam(':observation',$achat->observation);
                $statement->bindParam(':enreg_by',$achat->enreg_by);
                $statement->bindParam(':uuid',$achat->uuid);

                $statement->execute();

                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM PROD_achat WHERE uuid = :uuid"
                );

                $statement->bindParam(':uuid',$achat->uuid);

                $statement->execute();

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $achat->achat_id = $row['achat_id'];
                }
                                
                return $achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


        public function delete($achat)
        {
            try{
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_ligne_achat WHERE achat = :achat_id"
                );

                $statement->bindParam(':achat_id',$achat->achat_id);

                $statement->execute();
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM PROD_achat WHERE achat_id = :achat_id"
                );

                $statement->bindParam(':achat_id',$achat->achat_id);

                $statement->execute();
                                
                return $achat;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }