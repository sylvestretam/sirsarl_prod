<?php
    require_once("src/repository/matiere_premiere.php");
    require_once("src/repository/consommation.php");
    require_once("src/repository/ligne_consommation.php");

    class ConsommationController{

        private $dbconnect;

        private $repoArticle;
        private $repoUnite;
        private $repoMP;
        private $repoConsommation;
        private $repoLigneConsommation;

        private $matieres_premieres = [];
        private $consommations = [];
        private $lignes_consommations = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->repoArticle = new ArticleRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoMP = new Matiere_premiereRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoConsommation = new ConsommationRepository($this->dbconnect);
            $this->repoLigneConsommation = new Ligne_ConsommationRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $matieres_premieres = $this->matieres_premieres;
            $consommations = $this->consommations;

            $total_conso = array_reduce($this->consommations,function($carry, $object){ return  $carry+($object->valeur);},0);
            $nbre_conso = sizeof($consommations);
            $moyenne_conso = ($nbre_conso == 0) ? 0 : $total_conso / $nbre_conso;
            $last_conso = ($nbre_conso == 0) ? new Consommation() : $consommations[ sizeof($consommations)-1 ];

            require("template/consommation.php");
        }  

        public function init()
        {
            $this->consommations = $this->repoConsommation->getAll();
            $this->lignes_consommations = $this->repoLigneConsommation->getAll();
            $this->matieres_premieres = $this->repoMP->getAll();

            array_map(function($object){$object->setLignes($this->lignes_consommations);},$this->consommations);
            array_map(function($object){$object->setLignesConsommation($this->lignes_consommations);},$this->matieres_premieres);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveConsommation':
                    $consommation = new Consommation();
                    $consommation->date_conso = $_REQUEST['date_consommation'];
                    $consommation->observation = $_REQUEST['observation'];
                    $consommation->enreg_by = $_SESSION['matricule'];
                    $consommation->uuid = uniqid('conso_');

                    $repo = new ConsommationRepository($this->dbconnect);
                    $consommation = $repo->save($consommation);

                    $Lignes = json_decode($_REQUEST['ligne_consommation']);

                    foreach ($Lignes as $key => $value) 
                    {
                        $ligne = new Ligne_consommation();
                        $ligne->matiere_premiere = $key;
                        $ligne->quantite = $value->quantite;
                        $ligne->valeur = $value->valeur;
                        $ligne->pu = $value->valeur / $value->quantite;
                        $ligne->consommation = $consommation->conso_id;
        
                        $repo = new Ligne_consommationRepository($this->dbconnect);
                        $repo->save($ligne);
                    }

                    break;
                case 'deleteConsommation':
                    $Consommation = new Consommation();
                    $Consommation->conso_id = $_REQUEST['conso_id'];

                    $repo = new ConsommationRepository($this->dbconnect);
                    $Consommation = $repo->delete($Consommation);
                    break;
                default:
                    # code...
                    break;
            }

        }
    }