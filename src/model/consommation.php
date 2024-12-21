<?php

    class Consommation
    {
        public $conso_id;
        public $date_conso;
        public $valeur;
        public $observation;
        public $uuid;
        public $enreg_by;

        public $lignes = [];

        public function setLignes($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->consommation == $this->conso_id){
                    $this->lignes[] = $ligne;
                    $this->valeur = $this->valeur + $ligne->valeur;

                }
            }
        }
    }