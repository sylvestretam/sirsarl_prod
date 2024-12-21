#Ma base de données : 

DROP TABLE IF EXISTS PROD_achat;
CREATE TABLE PROD_achat(
        achat_id     integer auto_increment,
        date_achat     date,
        valeur     integer,
        observation     varchar(500),
        uuid     varchar(50),
        enreg_by     varchar(50),
        PRIMARY KEY (achat_id)
);



DROP TABLE IF EXISTS PROD_consommation;
CREATE TABLE PROD_consommation(
        conso_id     integer auto_increment,
        date_conso     date,
        valeur     integer,
        observation     varchar(500),
        uuid     varchar(50),
        enreg_by     varchar(50),
        PRIMARY KEY (conso_id)
);



DROP TABLE IF EXISTS PROD_production;
CREATE TABLE PROD_production(
        prod_id     integer auto_increment,
        date_prod     date,
        observation     varchar(500),
        uuid     varchar(50),
        enreg_by     varchar(50),
        PRIMARY KEY (prod_id)
);



-- DROP TABLE IF EXISTS BTL_article;
-- CREATE TABLE BTL_article(
--         code     varchar(25),
--         PRIMARY KEY (code)
-- );



-- DROP TABLE IF EXISTS BTL_unite_stock;
-- CREATE TABLE BTL_unite_stock(
--         code_unite     varchar(25),
--         PRIMARY KEY (code_unite)
-- );



DROP TABLE IF EXISTS PROD_matiere_premiere;
CREATE TABLE PROD_matiere_premiere(
        code_mp     varchar(25),
        designation     Varchar (255),
        unite     varchar(25),
        quantite_stock     integer default 0,
        pu_stock     float  default 0,
        valeur_stock     integer  default 0,
        PRIMARY KEY (code_mp)
);



DROP TABLE IF EXISTS PROD_expedition;
CREATE TABLE PROD_expedition(
        expedition_id     integer auto_increment,
        date_expedition     date,
        valeur     integer,
        observation     varchar(500),
        uuid     varchar(50),
        enreg_by     varchar(50),
        PRIMARY KEY (expedition_id)
);



DROP TABLE IF EXISTS PROD_ligne_production;
CREATE TABLE PROD_ligne_production(
        quantite     integer,
        valeur     integer,
        production     integer,
        article     varchar(25),
        unite     varchar(25),
        PRIMARY KEY (production,article,unite)
);



DROP TABLE IF EXISTS PROD_ligne_achat;
CREATE TABLE PROD_ligne_achat(
        quantite     integer,
        pu     float,
        valeur     integer,
        matiere_premiere     varchar(25),
        achat     integer,
        PRIMARY KEY (matiere_premiere,achat)
);



DROP TABLE IF EXISTS PROD_ligne_consommation;
CREATE TABLE PROD_ligne_consommation(
        quantite     integer,
        pu     float,
        valeur     integer,
        matiere_premiere     varchar(25),
        consommation     integer,
        PRIMARY KEY (matiere_premiere,consommation)
);



DROP TABLE IF EXISTS PROD_stock;
CREATE TABLE PROD_stock(
        quantite     integer,
        valeur     integer,
        unite     varchar(25),
        article     varchar(25),
        PRIMARY KEY (unite,article)
);



DROP TABLE IF EXISTS PROD_ligne_expedition;
CREATE TABLE PROD_ligne_expedition(
        quantite     integer,
        valeur     integer,
        unite     varchar(25),
        expedition     integer,
        article     varchar(25),
        PRIMARY KEY (unite,expedition,article)
);



ALTER TABLE PROD_ligne_production ADD CONSTRAINT FK_PROD_ligne_production_production FOREIGN KEY (production) REFERENCES PROD_production(prod_id);
ALTER TABLE PROD_ligne_production ADD CONSTRAINT FK_PROD_ligne_production_article FOREIGN KEY (article) REFERENCES BTL_article(code);
ALTER TABLE PROD_ligne_production ADD CONSTRAINT FK_PROD_ligne_production_unite FOREIGN KEY (unite) REFERENCES BTL_unite_stock(code_unite);
ALTER TABLE PROD_ligne_achat ADD CONSTRAINT FK_PROD_ligne_achat_matiere_premiere FOREIGN KEY (matiere_premiere) REFERENCES PROD_matiere_premiere(code_mp);
ALTER TABLE PROD_ligne_achat ADD CONSTRAINT FK_PROD_ligne_achat_achat FOREIGN KEY (achat) REFERENCES PROD_achat(achat_id);
ALTER TABLE PROD_ligne_consommation ADD CONSTRAINT FK_PROD_ligne_consommation_matiere_premiere FOREIGN KEY (matiere_premiere) REFERENCES PROD_matiere_premiere(code_mp);
ALTER TABLE PROD_ligne_consommation ADD CONSTRAINT FK_PROD_ligne_consommation_consommation FOREIGN KEY (consommation) REFERENCES PROD_consommation(conso_id);
ALTER TABLE PROD_stock ADD CONSTRAINT FK_PROD_stock_unite FOREIGN KEY (unite) REFERENCES BTL_unite_stock(code_unite);
ALTER TABLE PROD_stock ADD CONSTRAINT FK_PROD_stock_article FOREIGN KEY (article) REFERENCES BTL_article(code);
ALTER TABLE PROD_ligne_expedition ADD CONSTRAINT FK_PROD_ligne_expedition_unite FOREIGN KEY (unite) REFERENCES BTL_unite_stock(code_unite);
ALTER TABLE PROD_ligne_expedition ADD CONSTRAINT FK_PROD_ligne_expedition_expedition FOREIGN KEY (expedition) REFERENCES PROD_expedition(expedition_id);
ALTER TABLE PROD_ligne_expedition ADD CONSTRAINT FK_PROD_ligne_expedition_article FOREIGN KEY (article) REFERENCES BTL_article(code);
