<?php

    class Matiere_premiere
    {
        public $code_mp;
        public $designation;
        public $unite;
        public $quantite_stock;
        public $pu_stock;
        public $valeur_stock;

        public $lignes_achats = [];
        public $achat_a_date = 0;
        public $quantite_a_date = 0;

        public function setLignesAchat($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->matiere_premiere == $this->code_mp){
                    $this->lignes_achats[] = $ligne;
                    $this->achat_a_date = $this->achat_a_date + $ligne->valeur;
                    $this->quantite_a_date = $this->quantite_a_date + $ligne->quantite;
                }
            }
        }

        public $lignes_consommations = [];
        public $consommation_a_date = 0;
        public $quantite_conso_a_date = 0;

        public function setLignesConsommation($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->matiere_premiere == $this->code_mp){
                    $this->lignes_consommations[] = $ligne;
                    $this->consommation_a_date = $this->consommation_a_date + $ligne->valeur;
                    $this->quantite_conso_a_date = $this->quantite_conso_a_date + $ligne->quantite;
                }
            }
        }
    }