<?php

    class Expedition
    {
        public $expedition_id;
        public $date_expedition;
        public $valeur;
        public $observation;
        public $uuid;
        public $enreg_by;

        public $quantite = 0;

        public $lignes = [];

        public function setLignes($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->expedition == $this->expedition_id){
                    $this->lignes[] = $ligne;
                    $this->quantite  = $this->quantite + $ligne->quantite;
                }
            }
        }
    }