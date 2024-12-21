<?php

    class Unite_article
    {
        public $article;
        public $unite;
        
        public $qte_prod_a_date = 0;

        public $lignes_prod = [];

        public function setLignesProd($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->article == $this->article && $ligne->unite == $this->unite ){
                    $this->lignes_prod[] = $ligne;
                    $this->qte_prod_a_date = $this->qte_prod_a_date + $ligne->quantite;

                }
            }
        }

        public $qte_exp_a_date = 0;

        public $lignes_exp = [];

        public function setLignesexpedition($lignes)
        {
            foreach ($lignes as $ligne) {
                if( $ligne->article == $this->article && $ligne->unite == $this->unite ){
                    $this->lignes_exp[] = $ligne;
                    $this->qte_exp_a_date = $this->qte_exp_a_date + $ligne->quantite;

                }
            }
        }
    }