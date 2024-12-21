<?php

    require_once("src/repository/article.php");
    require_once("src/repository/unite_stock.php");
    require_once("src/repository/matiere_premiere.php");
    require_once("src/repository/achat.php");
    require_once("src/repository/ligne_achat.php");

    class AchatController{

        private $dbconnect;

        private $repoArticle;
        private $repoUnite;
        private $repoMP;
        private $repoAchat;
        private $repoLigneAchat;

        private $matieres_premieres = [];
        private $achats = [];
        private $lignes_achats = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->repoArticle = new ArticleRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoMP = new Matiere_premiereRepository($this->dbconnect);
            $this->repoUnite = new Unite_stockRepository($this->dbconnect);
            $this->repoAchat = new AchatRepository($this->dbconnect);
            $this->repoLigneAchat = new Ligne_achatRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $articles = $this->repoArticle->getAll();
            $unites_stocks = $this->repoUnite->getAll();
            $matieres_premieres = $this->matieres_premieres;
            $achats = $this->achats;

            $total_achat = array_reduce($this->achats,function($carry, $object){ return  $carry+($object->valeur);},0);
            $nbre_achat = sizeof($achats);
            $moyenne_achat = ($nbre_achat == 0) ? 0 : $total_achat / $nbre_achat;
            $last_achat = ($nbre_achat == 0) ? new Achat() : $achats[ sizeof($achats)-1 ];

            require("template/achat.php");
        }
        
        public function init()
        {
            $this->achats = $this->repoAchat->getAll();
            $this->lignes_achats = $this->repoLigneAchat->getAll();
            $this->matieres_premieres = $this->repoMP->getAll();

            array_map(function($object){$object->setLignes($this->lignes_achats);},$this->achats);
            array_map(function($object){$object->setLignesAchat($this->lignes_achats);},$this->matieres_premieres);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveAchat':
                    $achat = new Achat();
                    $achat->date_achat = $_REQUEST['date_achat'];
                    $achat->observation = $_REQUEST['observation'];
                    $achat->enreg_by = $_SESSION['matricule'];
                    $achat->uuid = uniqid('ach_');

                    $repo = new AchatRepository($this->dbconnect);
                    $achat = $repo->save($achat);

                    $Lignes = json_decode($_REQUEST['ligne_achat']);

                    foreach ($Lignes as $key => $value) 
                    {
                        $ligne = new Ligne_achat();
                        $ligne->matiere_premiere = $key;
                        $ligne->quantite = $value->quantite;
                        $ligne->valeur = $value->valeur;
                        $ligne->pu = $value->valeur / $value->quantite;
                        $ligne->achat = $achat->achat_id;
        
                        $repo = new Ligne_achatRepository($this->dbconnect);
                        $repo->save($ligne);
                    }

                    break;
                case 'deleteAchat':
                    $achat = new Achat();
                    $achat->achat_id = $_REQUEST['achat_id'];

                    $repo = new AchatRepository($this->dbconnect);
                    $achat = $repo->delete($achat);
                    break;
                default:
                    # code...
                    break;
            }

        }
    }