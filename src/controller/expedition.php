<?php

    require_once("src/repository/article.php");
    require_once("src/repository/unite_stock.php");
    require_once("src/repository/expedition.php");
    require_once("src/repository/ligne_expedition.php");
    require_once("src/repository/unite_article.php");

    class ExpeditionController{

        private $dbconnect;

        private $repoArticle;
        private $repoUnite;
        private $repoUniteArticle;
        private $repoexpedition;
        private $repoLigneexpedition;

        private $articles = [];
        private $unites = [];
        private $unites_articles = [];
        private $expeditions = [];
        private $lignes_expeditions = [];
        
        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->repoArticle = new ArticleRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoUniteArticle = new Unite_ArticleRepository($this->dbconnect);
            $this->repoexpedition = new ExpeditionRepository($this->dbconnect);
            $this->repoLigneexpedition = new Ligne_expeditionRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $expeditions = $this->expeditions;
            $articles = $this->articles;
            $unites = $this->unites;
            $unites_articles = $this->unites_articles;

            $total_expedition = array_reduce($this->expeditions,function($carry, $object){ return  $carry+($object->quantite);},0);
            $nbre_expedition = sizeof($expeditions);
            $moyenne_expedition = ($nbre_expedition == 0) ? 0 : $total_expedition / $nbre_expedition;
            $last_expedition =(sizeof($expeditions) == 0)? new Expedition() : $expeditions[ sizeof($expeditions)-1 ];

            require("template/expedition.php");
        }  

        public function init()
        {
            $this->expeditions = $this->repoexpedition->getAll();
            $this->lignes_expeditions = $this->repoLigneexpedition->getAll();
            $this->articles = $this->repoArticle->getAll();
            $this->unites = $this->repoUnite->getAll();
            $this->unites_articles = $this->repoUniteArticle->getAll();

            array_map(function($object){$object->setLignes($this->lignes_expeditions);},$this->expeditions);
            array_map(function($object){$object->setLignesexpedition($this->lignes_expeditions);},$this->unites_articles);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveExpedition':
                    $expedition = new Expedition();
                    $expedition->date_expedition = $_REQUEST['date_expedition'];
                    $expedition->observation = $_REQUEST['observation'];
                    $expedition->enreg_by = $_SESSION['matricule'];
                    $expedition->uuid = uniqid('exp_');

                    $repo = new expeditionRepository($this->dbconnect);
                    $expedition = $repo->save($expedition);

                    $Lignes = json_decode($_REQUEST['ligne_expedition']);
                    // var_dump($Lignes);

                    foreach ($Lignes as $key => $value) 
                    {
                        $ligne = new Ligne_expedition();
                        $ligne->article = $key;
                        $ligne->quantite = $value->quantite;
                        $ligne->unite = $value->unite;
                        $ligne->expedition = $expedition->expedition_id;
        
                        $repo = new Ligne_expeditionRepository($this->dbconnect);
                        $repo->save($ligne);
                    }

                    break;
                case 'deleteExpedition':
                    $expedition = new Expedition();
                    $expedition->expedition_id = $_REQUEST['expedition_id'];

                    $repo = new expeditionRepository($this->dbconnect);
                    $expedition = $repo->delete($expedition);
                    break;
                default:
                    # code...
                    break;
            }

        }
    }