<?php
    require_once("src/repository/article.php");
    require_once("src/repository/unite_stock.php");
    require_once("src/repository/production.php");
    require_once("src/repository/ligne_production.php");
    require_once("src/repository/unite_article.php");

    class ProductionController{

        private $dbconnect;

        private $repoArticle;
        private $repoUnite;
        private $repoUniteArticle;
        private $repoProduction;
        private $repoLigneProduction;

        private $articles = [];
        private $unites = [];
        private $unites_articles = [];
        private $productions = [];
        private $lignes_productions = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->repoArticle = new ArticleRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoUniteArticle = new Unite_ArticleRepository($this->dbconnect);
            $this->repoProduction = new ProductionRepository($this->dbconnect);
            $this->repoLigneProduction = new Ligne_productionRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $productions = $this->productions;
            $articles = $this->articles;
            $unites = $this->unites;
            $unites_articles = $this->unites_articles;

            $total_prod = array_reduce($this->productions,function($carry, $object){ return  $carry+($object->quantite);},0);
            $nbre_prod = sizeof($productions);
            $moyenne_prod = ($nbre_prod == 0) ? 0 : $total_prod / $nbre_prod;
            $last_prod = ($nbre_prod == 0) ? new Production() : $productions[ sizeof($productions)-1 ];

            require("template/production.php");
        }
        
        public function init()
        {
            $this->productions = $this->repoProduction->getAll();
            $this->lignes_productions = $this->repoLigneProduction->getAll();
            $this->articles = $this->repoArticle->getAll();
            $this->unites = $this->repoUnite->getAll();
            $this->unites_articles = $this->repoUniteArticle->getAll();

            array_map(function($object){$object->setLignes($this->lignes_productions);},$this->productions);
            array_map(function($object){$object->setLignesProd($this->lignes_productions);},$this->unites_articles);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveProduction':
                    $production = new Production();
                    $production->date_prod = $_REQUEST['date_prod'];
                    $production->observation = $_REQUEST['observation'];
                    $production->enreg_by = $_SESSION['matricule'];
                    $production->uuid = uniqid('prod_');

                    $repo = new productionRepository($this->dbconnect);
                    $production = $repo->save($production);

                    $Lignes = json_decode($_REQUEST['ligne_production']);
                    // var_dump($Lignes);

                    foreach ($Lignes as $key => $value) 
                    {
                        $ligne = new Ligne_production();
                        $ligne->article = $key;
                        $ligne->quantite = $value->quantite;
                        $ligne->unite = $value->unite;
                        $ligne->production = $production->prod_id;
        
                        $repo = new Ligne_productionRepository($this->dbconnect);
                        $repo->save($ligne);
                    }

                    break;
                case 'deleteproduction':
                    $production = new production();
                    $production->prod_id = $_REQUEST['prod_id'];

                    $repo = new productionRepository($this->dbconnect);
                    $production = $repo->delete($production);
                    break;
                default:
                    # code...
                    break;
            }

        }

    }