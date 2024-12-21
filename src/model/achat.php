<?php

    class Achat
    {
        public $achat_id;
        public $date_achat;
        public $valeur = 0;
        public $observation;
        public $enreg_by;
        public $uuid;

        public $lignes = [];

        public function setLignes($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->achat == $this->achat_id){
                    $this->lignes[] = $ligne;
                    $this->valeur = $this->valeur + $ligne->valeur;

                }
            }
        }
    }