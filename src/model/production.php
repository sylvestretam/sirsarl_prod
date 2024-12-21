<?php

    class Production
    {
        public $prod_id;
        public $date_prod;
        public $observation;
        public $uuid;
        public $enreg_by;

        public $quantite = 0;

        public $lignes = [];

        public function setLignes($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->production == $this->prod_id){
                    $this->lignes[] = $ligne;
                    $this->quantite  = $this->quantite + $ligne->quantite;
                }
            }
        }
    }