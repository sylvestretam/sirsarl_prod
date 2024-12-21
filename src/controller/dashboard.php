<?php
    require_once("src/repository/matiere_premiere.php");
    require_once("src/repository/achat.php");
    require_once("src/repository/ligne_achat.php");
    require_once("src/repository/consommation.php");
    require_once("src/repository/ligne_consommation.php");
    require_once("src/repository/article.php");
    require_once("src/repository/unite_stock.php");
    require_once("src/repository/production.php");
    require_once("src/repository/ligne_production.php");
    require_once("src/repository/expedition.php");
    require_once("src/repository/ligne_expedition.php");
    require_once("src/repository/unite_article.php");

    class DashboardController{

        private $dbconnect;
        private $repoMP;
        private $repoConsommation;
        private $repoLigneConsommation;
        private $repoAchat;
        private $repoLigneAchat;
        private $repoArticle;
        private $repoUnite;
        private $repoUniteArticle;
        private $repoexpedition;
        private $repoLigneexpedition;
        private $repoProduction;
        private $repoLigneProduction;

        private $matieres_premieres = [];
        private $consommations = [];
        private $lignes_consommations = [];
        private $achats = [];
        private $lignes_achats = [];

        private $articles = [];
        private $unites = [];
        private $unites_articles = [];
        private $productions = [];
        private $lignes_productions = [];
        private $expeditions = [];
        private $lignes_expeditions = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->repoArticle = new ArticleRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoUniteArticle = new Unite_ArticleRepository($this->dbconnect);
            $this->repoProduction = new ProductionRepository($this->dbconnect);
            $this->repoLigneProduction = new Ligne_productionRepository($this->dbconnect);
            $this->repoexpedition = new ExpeditionRepository($this->dbconnect);
            $this->repoLigneexpedition = new Ligne_expeditionRepository($this->dbconnect);

            
            $this->repoMP = new Matiere_premiereRepository($this->dbconnect);
            $this->repoAchat = new AchatRepository($this->dbconnect);
            $this->repoLigneAchat = new Ligne_achatRepository($this->dbconnect);

            
            $this->repoConsommation = new ConsommationRepository($this->dbconnect);
            $this->repoLigneConsommation = new Ligne_ConsommationRepository($this->dbconnect);

            $this->init();
            
        }

        public function show()
        {

            $productions = $this->productions;
            $expeditions = $this->expeditions;
            $consommations = $this->consommations;
            $achats = $this->achats;

            $matieres_premieres = $this->matieres_premieres;
            $unites_articles = $this->unites_articles;

            $total_achat = array_reduce($this->achats,function($carry, $object){ return  $carry+($object->valeur);},0);
            $total_consommation = array_reduce($this->consommations,function($carry, $object){ return  $carry+($object->valeur);},0);
            $total_expedition = array_reduce($this->expeditions,function($carry, $object){ return  $carry+($object->quantite);},0);
            $total_production = array_reduce($this->productions,function($carry, $object){ return  $carry+($object->quantite);},0);

            require("template/dashboard.php");
        }  

        public function init()
        {
            $this->matieres_premieres = $this->repoMP->getAll();

            
            $this->articles = $this->repoArticle->getAll();
            $this->unites = $this->repoUnite->getAll();
            $this->unites_articles = $this->repoUniteArticle->getAll();

            $this->consommations = $this->repoConsommation->getAll();
            $this->lignes_consommations = $this->repoLigneConsommation->getAll();

            $this->achats = $this->repoAchat->getAll();
            $this->lignes_achats = $this->repoLigneAchat->getAll();

            $this->productions = $this->repoProduction->getAll();
            $this->lignes_productions = $this->repoLigneProduction->getAll();

            $this->expeditions = $this->repoexpedition->getAll();
            $this->lignes_expeditions = $this->repoLigneexpedition->getAll();

            
            $this->matieres_premieres = $this->repoMP->getAll();

            array_map(function($object){$object->setLignes($this->lignes_expeditions);},$this->expeditions);
            array_map(function($object){$object->setLignesexpedition($this->lignes_expeditions);},$this->unites_articles);

            array_map(function($object){$object->setLignes($this->lignes_productions);},$this->productions);
            array_map(function($object){$object->setLignesProd($this->lignes_productions);},$this->unites_articles);

            array_map(function($object){$object->setLignes($this->lignes_achats);},$this->achats);
            array_map(function($object){$object->setLignesAchat($this->lignes_achats);},$this->matieres_premieres);

            array_map(function($object){$object->setLignes($this->lignes_consommations);},$this->consommations);
            array_map(function($object){$object->setLignesConsommation($this->lignes_consommations);},$this->matieres_premieres);

        }
    }